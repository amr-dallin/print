<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Purchases helper
 */
class PurchasesHelper extends Helper
{
    public $helpers = ['Html', 'Number', 'PurchaseEntities'];

    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    public function isApproved($purchase)
    {
        return ($purchase->status === '2') ? true : false;
    }

    public function listOfStatuses()
    {
        return [
            PURCHASE_STATUS_NOT_APPROVED => __('Not approved'),
            PURCHASE_STATUS_APPROVED => __('Approved')
        ];
    }

    public function statusIcon($purchase)
    {
        switch($purchase->status) {
            case PURCHASE_STATUS_NOT_APPROVED:
                return $this->Html->tag('span', $this->listOfStatuses()[PURCHASE_STATUS_NOT_APPROVED], ['class' => 'badge badge-warning']);
                break;
            case PURCHASE_STATUS_APPROVED:
                return $this->Html->tag('span', $this->listOfStatuses()[PURCHASE_STATUS_APPROVED], ['class' => 'badge badge-success']);
                break;
        }
    }

    public function total($purchaseEntities, $model = null)
    {
        $total = (string)0;
        foreach($purchaseEntities as $purchaseEntity) {
            if (null !== $model && $purchaseEntity->model != $model) {
                continue;
            }
            $total = bcadd($total, $this->PurchaseEntities->total($purchaseEntity), 4);
        }

        return $total;
    }

    public function totalAll($purchases)
    {
        $total = (string)0;
        foreach($purchases as $purchase) {
            $total = bcadd($total, $this->total($purchase->purchase_entities), 4);
        }

        return $total;
    }

    public function totalConsumables($purchases)
    {
        $total = (string)0;
        foreach($purchases as $purchase) {
            $total = bcadd($total, $this->total($purchase->purchase_entities, 'Consumables'), 4);
        }

        return $total;
    }

    public function totalPapers($purchases)
    {
        $total = (string)0;
        foreach($purchases as $purchase) {
            $total = bcadd($total, $this->total($purchase->purchase_entities, 'Papers'), 4);
        }

        return $total;
    }
}
