<?php
declare(strict_types=1);

namespace App\Service;

use App\Service\OrdersService;
use Cake\Database\Expression\QueryExpression;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\FrozenTime;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\Utility\Inflector;

class OrderProductsService
{
    use LocatorAwareTrait;

    public function changeStatus($orderProduct)
    {
        switch($orderProduct->status) {
            case ORDER_PRODUCTS_STATUS_IN_PROGRESS:
                $orderProduct->set('date_completed', null);
                $orderProduct->set('status_message', null);
                break;
            case ORDER_PRODUCTS_STATUS_COMPLETED:
                $orderProduct->set('status_message', null);
                break;
            case ORDER_PRODUCTS_STATUS_PROBLEM:
                $orderProduct->set('date_completed', null);
                break;
        }

        if ($this->getTableLocator()->get('OrderProducts')->save($orderProduct)) {
            return (new OrdersService())->status($orderProduct->order_id);
        }
        return false;
    }

    public function specifyContractor($orderProduct)
    {
        $contractor = $this->getTableLocator()->get('Contractors')->findById($orderProduct->contractor_id)
            ->contain('Representatives.PhoneNumbers')
            ->firstOrFail();

        $orderProduct->set('contractor_full_name', $contractor->representative->full_name);
        $orderProduct->set('contractor_telephone', $contractor->representative->phone_number->full_number);

        if ($this->getTableLocator()->get('OrderProducts')->save($orderProduct)) {
            return true;
        }

        return false;
    }

    public function save($orderProduct)
    {
        if ($orderProduct->isNew()) {
            $orderProduct = $this->setUniqueId($orderProduct);
            $orderProduct = $this->setInProgressStatus($orderProduct);
        }
        $orderProduct = $this->setTypeInfo($orderProduct);
        if ($this->getTableLocator()->get('OrderProducts')->save($orderProduct)) {
            (new OrdersService())->status($orderProduct->order_id);

            // Если продукт выполняется на стороне, себестоимость указывается сразу,
            // поэтому здесь это условие.
            if ($orderProduct->type === ORDER_PRODUCTS_TYPE_OUTSOURCING) {
                (new OrdersService())->cost($orderProduct->order_id);
            }
            return $orderProduct;
        }
        return false;
    }

    public function cost($orderProductId)
    {
        $orderProduct = $this->getTableLocator()->get('OrderProducts')->findById($orderId)
            ->contain([
                'ProductProcesses' => [
                    'ProcessConsumables',
                    'ProcessPapers'
                ]
            ])
            ->firstOrFail();
    }

    public function setTypeInfo($orderProduct)
    {
        if (!$orderProduct->isDirty('type')) {
            return $orderProduct;
        }

        if ($orderProduct->type === ORDER_PRODUCTS_TYPE_INDEPENDENTLY) {
            $orderProduct->set('contractor_id', null);
            $orderProduct->set('contractor_full_name', null);
            $orderProduct->set('contractor_telephone', null);
        } else if ($orderProduct->type === ORDER_PRODUCTS_TYPE_OUTSOURCING && !empty($orderProduct->contractor_id)) {
            $contractor = $this->getTableLocator()->get('Contractors')->findById($orderProduct->contractor_id)
                ->contain('Representatives.PhoneNumbers')
                ->firstOrFail();

            $orderProduct->set('contractor_full_name', $contractor->representative->full_name);
            $orderProduct->set('contractor_telephone', $contractor->representative->phone_number->full_number);
        }

        return $orderProduct;
    }

    private function setInProgressStatus($orderProduct)
    {
        return $orderProduct->set('status', ORDER_PRODUCTS_STATUS_IN_PROGRESS);
    }

    private function setUniqueId($orderProduct)
    {
        return $orderProduct->set('unique_id', uniqid());
    }
}