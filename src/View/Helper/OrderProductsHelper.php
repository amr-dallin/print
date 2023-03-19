<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * OrderProducts helper
 */
class OrderProductsHelper extends Helper
{
    public $helpers = ['Html', 'Number'];

    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    public function typeIcon($type)
    {
        switch($type) {
            case ORDER_PRODUCTS_TYPE_INDEPENDENTLY:
                return $this->Html->tag('span', $this->typeList()[ORDER_PRODUCTS_TYPE_INDEPENDENTLY], ['class' => 'badge badge-success']);
                break;
            case ORDER_PRODUCTS_TYPE_OUTSOURCING:
                return $this->Html->tag('span', $this->typeList()[ORDER_PRODUCTS_TYPE_OUTSOURCING], ['class' => 'badge badge-warning']);
                break;
        }
    }

    public function typeList()
    {
        return [
            ORDER_PRODUCTS_TYPE_INDEPENDENTLY => __('Independently'),
            ORDER_PRODUCTS_TYPE_OUTSOURCING => __('Outsourcing')
        ];
    }

    public function isIndependently($type)
    {
        return ($type === ORDER_PRODUCTS_TYPE_INDEPENDENTLY) ? true : false;
    }

    public function isOutsourcing($type)
    {
        return ($type === ORDER_PRODUCTS_TYPE_OUTSOURCING) ? true : false;
    }

    public function listOfStatuses()
    {
        return [
            ORDER_PRODUCTS_STATUS_IN_PROGRESS => __('In progress'),
            ORDER_PRODUCTS_STATUS_COMPLETED => __('Completed'),
            ORDER_PRODUCTS_STATUS_PROBLEM => __('Problem')
        ];
    }

    public function statusIcon($status)
    {
        switch($status) {
            case ORDER_PRODUCTS_STATUS_IN_PROGRESS:
                return $this->Html->tag('span', $this->listOfStatuses()[ORDER_PRODUCTS_STATUS_IN_PROGRESS], ['class' => 'badge badge-warning']);
                break;
            case ORDER_PRODUCTS_STATUS_COMPLETED:
                return $this->Html->tag('span', $this->listOfStatuses()[ORDER_PRODUCTS_STATUS_COMPLETED], ['class' => 'badge badge-success']);
                break;
            case ORDER_PRODUCTS_STATUS_PROBLEM:
                return $this->Html->tag('span', $this->listOfStatuses()[ORDER_PRODUCTS_STATUS_PROBLEM], ['class' => 'badge badge-danger']);
                break;
        }
    }

    public function isInProgressStatus($orderProduct)
    {
        return (($orderProduct->status === ORDER_PRODUCTS_STATUS_IN_PROGRESS)) ? true : false;
    }

    public function isCompletedStatus($orderProduct)
    {
        return ($orderProduct->status === ORDER_PRODUCTS_STATUS_COMPLETED) ? true : false;
    }

    public function isProblemStatus($orderProduct)
    {
        return ($orderProduct->status === ORDER_PRODUCTS_STATUS_PROBLEM) ? true : false;
    }

    public function savedPriceView($orderProduct)
    {
        if (empty($orderProduct->competitive_price)) {
            return __('Undefined');
        }

        $savedPrice = bcsub(
            bcmul(
                (string)$orderProduct->quantity,
                (string)$orderProduct->competitive_price,
                4
            ),
            (string)$orderProduct->cost_price,
            4
        );

        return $this->Number->currency($savedPrice, 'UZS');
    }

    public function profitPriceView($orderProduct)
    {
        if (empty($orderProduct->profit_price)) {
            return __('Undefined');
        }

        $profitPrice = bcsub(
            bcmul(
                (string)$orderProduct->quantity,
                (string)$orderProduct->profit_price,
                4
            ),
            (string)$orderProduct->cost_price,
            4
        );

        return $this->Number->currency($profitPrice, 'UZS');
    }

    public function costPriceOfOneCopy($orderProduct)
    {
        return bcdiv(
            (string)$orderProduct->cost_price,
            (string)$orderProduct->quantity,
            4
        );
    }
}
