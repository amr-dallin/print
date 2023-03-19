<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Orders helper
 */
class OrdersHelper extends Helper
{
    public $helpers = ['Html', 'Number', 'OrderProducts'];

    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    public function notSpecifiedClient($order)
    {
        return (null === $order->client_id) ? true : false;
    }

    public function specifiedClient($order)
    {
        return (null !== $order->client_id) ? true : false;
    }

    public function navigationSlug($status)
    {
        switch($status) {
            case ORDERS_STATUS_ESTIMATED:
                return 'Estimated';
                break;
            case ORDERS_STATUS_IN_PROGRESS:
                return 'InProgress';
                break;
            case ORDERS_STATUS_STATEMENT_COMPLETED:
                return 'StatementCompleted';
                break;
            case ORDERS_STATUS_COMPLETED:
                return 'Completed';
                break;
            case ORDERS_STATUS_PROBLEM:
                return 'Problem';
                break;
        }
    }

    public function statusIcon($status)
    {
        switch($status) {
            case ORDERS_STATUS_ESTIMATED:
                return $this->Html->tag('span', $this->statusList()[ORDERS_STATUS_ESTIMATED], ['class' => 'badge badge-primary']);
                break;
            case ORDERS_STATUS_IN_PROGRESS:
                return $this->Html->tag('span', $this->statusList()[ORDERS_STATUS_IN_PROGRESS], ['class' => 'badge badge-warning']);
                break;
            case ORDERS_STATUS_STATEMENT_COMPLETED:
                return $this->Html->tag('span', $this->statusList()[ORDERS_STATUS_STATEMENT_COMPLETED], ['class' => 'badge badge-secondary']);
                break;
            case ORDERS_STATUS_COMPLETED:
                return $this->Html->tag('span', $this->statusList()[ORDERS_STATUS_COMPLETED], ['class' => 'badge badge-success']);
                break;
            case ORDERS_STATUS_PROBLEM:
                return $this->Html->tag('span', $this->statusList()[ORDERS_STATUS_PROBLEM], ['class' => 'badge badge-danger']);
                break;
        }
    }

    public function statusList()
    {
        return [
            ORDERS_STATUS_ESTIMATED => __('Estimated'),
            ORDERS_STATUS_IN_PROGRESS => __('In progress'),
            ORDERS_STATUS_STATEMENT_COMPLETED => __('Statement completed'),
            ORDERS_STATUS_COMPLETED => __('Completed'),
            ORDERS_STATUS_PROBLEM => __('Problem')
        ];
    }

    public function isEstimatedStatus($order)
    {
        return ($order->status === ORDERS_STATUS_ESTIMATED) ? true : false;
    }

    public function isInProgressStatus($order)
    {
        return ($order->status === ORDERS_STATUS_IN_PROGRESS) ? true : false;
    }

    public function isStatementCompletedStatus($order)
    {
        return ($order->status === ORDERS_STATUS_STATEMENT_COMPLETED) ? true : false;
    }

    public function isCompletedStatus($order)
    {
        return ($order->status === ORDERS_STATUS_COMPLETED) ? true : false;
    }

    public function isNotCompletedStatus($order)
    {
        return ($order->status === ORDERS_STATUS_COMPLETED) ? false : true;
    }

    public function isProblemStatus($order)
    {
        return ($order->status === ORDERS_STATUS_PROBLEM) ? true : false;
    }

    public function issetProductsAndProcesses($order)
    {
        if (!isset($order->order_products) || empty($order->order_products)) {
            return false;
        }

        foreach($order->order_products as $orderProduct) {
            if (
                $this->OrderProducts->isIndependently($orderProduct->type) &&
                (
                    !isset($orderProduct->product_processes) ||
                    empty($orderProduct->product_processes)
                )
            ) {
                return false;
            }
        }

        return true;
    }

    public function specifiedDate($order)
    {
        if (!empty($order->date_deadline) && !empty($order->date_accepted)) {
            return true;
        }

        return false;
    }

    public function isTransferToInProgressStatus($order)
    {
        if (
            $this->isEstimatedStatus($order) &&
            $this->specifiedClient($order) &&
            $this->specifiedDate($order) &&
            $this->issetProductsAndProcesses($order)
        ) {
            return true;
        }

        return false;
    }

    public function savedPriceView($order)
    {
        if (empty($order->saved_price)) {
            return __('Undefined');
        }

        return $this->Number->currency($order->saved_price, 'UZS');
    }

    public function profitPriceView($order)
    {
        if (empty($order->profit_cost)) {
            return __('Undefined');
        }

        return $this->Number->currency($order->profit_cost, 'UZS');
    }

    public function totalCostPrice($orders)
    {
        $totalCostPrice = (string)0;
        foreach($orders as $order) {
            $totalCostPrice = bcadd($totalCostPrice, (string)$order->cost_price, 4);
        }

        return $totalCostPrice;
    }

    public function totalSavedPrice($orders)
    {
        $totalSavedPrice = (string)0;
        foreach($orders as $order) {
            $totalSavedPrice = bcadd($totalSavedPrice, (string)$order->saved_price, 4);
        }

        return $totalSavedPrice;
    }

    public function totalProfitCost($orders)
    {
        $totalProfitCost = (string)0;
        foreach($orders as $order) {
            $totalProfitCost = bcadd($totalProfitCost, (string)$order->profit_cost, 4);
        }

        return $totalProfitCost;
    }

    public function totalIncome($orders)
    {
        $totalIncome = (string)0;
        foreach($orders as $order) {
            $income = (string)0;
            if (!empty($order->saved_price)) {
                $income = (string)$order->saved_price;
            } elseif (!empty($order->profit_cost)) {
                $income = (string)$order->profit_cost;
            }
            $totalIncome = bcadd($totalIncome, $income, 4);
        }

        return $totalIncome;
    }
}
