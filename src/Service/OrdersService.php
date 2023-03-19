<?php
declare(strict_types=1);

namespace App\Service;

use Cake\Database\Expression\QueryExpression;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\FrozenTime;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\Utility\Inflector;

class OrdersService
{
    use LocatorAwareTrait;

    public function create()
    {
        $order = $this->getTableLocator()->get('Orders')->newEmptyEntity();
        $order = $this->setEstimatedStatus($order);
        $order = $this->setUniqueId($order);

        if ($this->getTableLocator()->get('Orders')->save($order)) {
            return $order;
        }

        return false;
    }

    public function specifyClient($order)
    {
        $client = $this->getTableLocator()->get('Clients')->findById($order->client_id)
            ->contain('Representatives.PhoneNumbers')
            ->firstOrFail();

        $order->set('client_full_name', $client->representative->full_name);
        $order->set('client_telephone', $client->representative->phone_number->full_number);

        if ($this->getTableLocator()->get('Orders')->save($order)) {
            return true;
        }

        return false;
    }

    public function inProgress($order)
    {
        $order->set('status', ORDERS_STATUS_IN_PROGRESS);
        if ($this->getTableLocator()->get('Orders')->save($order)) {
            $this->status($order->id);
            return true;
        }
        return false;
    }

    public function completed($order)
    {
        $order->set('status', ORDERS_STATUS_COMPLETED);
        if ($this->getTableLocator()->get('Orders')->save($order)) {
            return true;
        }
        return false;
    }

    private function setEstimatedStatus($order)
    {
        return $order->set('status', ORDERS_STATUS_ESTIMATED);
    }

    private function setUniqueId($order)
    {
        return $order->set('unique_id', uniqid());
    }

    public function status($orderId)
    {
        $order = $this->getTableLocator()->get('Orders')->findById($orderId)
            ->contain('OrderProducts.ProductProcesses')
            ->firstOrFail();

        if ($order->status === ORDERS_STATUS_ESTIMATED) {
            return true;
        }

        $orderEstimated = false;
        $orderProductCompleted = 0;
        $orderProductProblem = 0;
        if (!empty($order->order_products)) {
            foreach($order->order_products as $key => $orderProduct) {
                if ($orderProduct->type === ORDER_PRODUCTS_TYPE_OUTSOURCING) {
                    switch($orderProduct->status) {
                        case ORDER_PRODUCTS_STATUS_COMPLETED:
                            $orderProductCompleted++;
                            break;
                        case ORDER_PRODUCTS_STATUS_PROBLEM:
                            $orderProductProblem++;
                            break;
                    }
                    continue;
                } elseif (
                    ($orderProduct->type === ORDER_PRODUCTS_TYPE_INDEPENDENTLY) &&
                    empty($orderProduct->product_processes)
                ) {
                    $orderEstimated = true;
                    continue;
                }
    
                $productProcessCompleted = 0;
                $productProcessProblem = 0;
                foreach($orderProduct->product_processes as $productProcess) {
                    switch($productProcess->status) {
                        case PRODUCT_PROCESSES_STATUS_COMPLETED:
                            $productProcessCompleted++;
                            break;
                        case PRODUCT_PROCESSES_STATUS_PROBLEM:
                            $productProcessProblem++;
                            break;
                    }
                }
    
                if ($productProcessCompleted === count($orderProduct->product_processes)) {
                    $order->order_products[$key]->set('status', ORDER_PRODUCTS_STATUS_COMPLETED);
                    $orderProductCompleted++;
                } elseif ($productProcessProblem > 0) {
                    $order->order_products[$key]->set('status', ORDER_PRODUCTS_STATUS_PROBLEM);
                    $orderProductProblem++;
                } else {
                    $order->order_products[$key]->set('status', ORDER_PRODUCTS_STATUS_IN_PROGRESS);
                }
                $order->setDirty('order_products', true);
            }
        } else {
            $orderEstimated = true;
        }

        if ($orderEstimated) {
            $order->set('status', ORDERS_STATUS_ESTIMATED);
            $order->set('date_completed', null);
            $order->set('status_message', null);
        } elseif ($orderProductCompleted === count($order->order_products)) {
            $order->set('status', ORDERS_STATUS_STATEMENT_COMPLETED);
            $order->set('status_message', null);
        } elseif ($orderProductProblem > 0) {
            $order->set('status', ORDERS_STATUS_PROBLEM);
            $order->set('date_completed', null);
        } else {
            $order->set('status', ORDERS_STATUS_IN_PROGRESS);
            $order->set('date_completed', null);
            $order->set('status_message', null);
        }

        if ($this->getTableLocator()->get('Orders')->save($order, [
            'associated' => ['OrderProducts']
        ])) {
            return true;
        }
        return false;
    }

    public function cost($orderId)
    {
        $order = $this->getTableLocator()->get('Orders')->findById($orderId)
            ->contain([
                'Clients',
                'OrderProducts.ProductProcesses' => [
                    'ProcessConsumables',
                    'ProcessPapers'
                ]
            ])
            ->firstOrFail();

        $orderProductCostPrice = null;
        $orderCostPrice = null;
        $orderSavedPrice = null;
        $orderProfitCost = null;
        if (!empty($order->order_products)) {
            foreach($order->order_products as $key => $orderProduct) {
                if ($orderProduct->type === ORDER_PRODUCTS_TYPE_INDEPENDENTLY && empty($orderProduct->product_processes)) {
                    continue;
                }

                if ($orderProduct->type === ORDER_PRODUCTS_TYPE_OUTSOURCING) {
                    $orderProductCostPrice = (string)$orderProduct->cost_price;
                } elseif (!empty($orderProduct->product_processes)) {
                    $orderProductCostPrice = (string)0;
                    foreach($orderProduct->product_processes as $productProcess) {
                        $orderProductCostPrice = bcadd(
                            $orderProductCostPrice,
                            (string)$productProcess->cost_price,
                            4
                        );
                        if (!empty($productProcess->process_consumables)) {
                            foreach($productProcess->process_consumables as $processConsumable) {
                                $orderProductCostPrice = bcadd(
                                    $orderProductCostPrice,
                                    (string)$processConsumable->cost_price,
                                    4
                                );
                            }
                        }
                        if (!empty($productProcess->process_papers)) {
                            foreach($productProcess->process_papers as $processPaper) {
                                $orderProductCostPrice = bcadd(
                                    $orderProductCostPrice,
                                    (string)$processPaper->cost_price,
                                    4
                                );
                            }
                        }
                    }
                    $order->order_products[$key]->set('cost_price', $orderProductCostPrice);
                    $order->setDirty('order_products', true);
                }
                
                $orderCostPrice = bcadd(
                    (string)$orderCostPrice,
                    $orderProductCostPrice,
                    4
                );
    
                if (null !== $order->client_id) {
                    if ($order->client->type === CLIENTS_TYPE_INTERNAL && !empty($orderProduct->competitive_price)) {
                        // Saved price
                        $orderSavedPrice = bcadd(
                            (string)$orderSavedPrice,
                            bcsub(
                                bcmul(
                                    (string)$orderProduct->quantity,
                                    (string)$orderProduct->competitive_price,
                                    4
                                ),
                                (string)$orderProductCostPrice,
                                4
                            ),
                            4
                        );
        
                    } elseif ($order->client->type === CLIENTS_TYPE_EXTERNAL && !empty($orderProduct->profit_price)) {
                        // Profit cost
                        $orderProfitCost = bcadd(
                            (string)$orderProfitCost,
                            bcsub(
                                bcmul(
                                    (string)$orderProduct->quantity,
                                    (string)$orderProduct->profit_price,
                                    4
                                ),
                                (string)$orderProductCostPrice,
                                4
                            ),
                            4
                        );
                    }
                }
            }
        }
        
        $order->set('cost_price', $orderCostPrice);
        $order->set('saved_price', $orderSavedPrice);
        $order->set('profit_cost', $orderProfitCost);
        if ($this->getTableLocator()->get('Orders')->save($order)) {
            return true;
        }

        return false;
    }
}