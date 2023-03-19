<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Consumables helper
 */
class ConsumablesHelper extends Helper
{
    public $helpers = ['ConsumablePrices', 'Html', 'Number'];

    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    public function typeIcon($type)
    {
        switch($type) {
            case CONSUMABLES_TYPE_NOT_USED:
                return $this->Html->tag('span', $this->typeList()[CONSUMABLES_TYPE_NOT_USED], ['class' => 'badge badge-warning']);
                break;
            case CONSUMABLES_TYPE_USED:
                return $this->Html->tag('span', $this->typeList()[CONSUMABLES_TYPE_USED], ['class' => 'badge badge-success']);
                break;
        }
    }

    public function typeList()
    {
        return [
            CONSUMABLES_TYPE_NOT_USED => __('Not used in calculations'),
            CONSUMABLES_TYPE_USED => __('Used in calculations')
        ];
    }

    public function usedInCalculation($type)
    {
        return ($type === CONSUMABLES_TYPE_USED) ? true : false;
    }

    public function unit($consumable)
    {
        if ($this->usedInCalculation($consumable->type)) {
            return "{$consumable->initial_unit->title} ({$consumable->quantity} {$consumable->unit->title})";
        }

        return $consumable->initial_unit->title;
    }

    public function currentPrice($consumablePrices)
    {
        foreach($consumablePrices as $consumablePrice) {
            if ($this->ConsumablePrices->isCurrent($consumablePrice)) {
                return $consumablePrice->amount;
            }
        }
    }

    public function currentPriceDateCommited($consumablePrices)
    {
        foreach($consumablePrices as $consumablePrice) {
            if ($this->ConsumablePrices->isCurrent($consumablePrice)) {
                return $consumablePrice->date_commited;
            }
        }
    }

    public function currentPriceView($consumablePrices)
    {
        $currentPrice = $this->currentPrice($consumablePrices);
        $currentPriceDateCommited = $this->currentPriceDateCommited($consumablePrices);
        if (!empty($currentPrice)) {
            return $this->Number->currency($currentPrice, 'UZS') . ' (' . $currentPriceDateCommited->format('d.m.Y') . ')';
        }
        return __('Not determined');
    }

    public function unitPrice($consumable, $purchaseEntity)
    {
        if ($this->usedInCalculation($consumable->type) && !empty($consumable->quantity)) {
            return bcdiv((string)$purchaseEntity->amount, (string)$consumable->quantity, 4);
        }
    }
}
