<?php
declare(strict_types=1);

namespace App\Service;

use Cake\I18n\FrozenTime;
use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Locator\LocatorAwareTrait;

class ConsumablePricesService
{
    use LocatorAwareTrait;

    public function save($consumablePrice)
    {
        $oldConsumablePrices = $this->getTableLocator()->get('ConsumablePrices')->find()
            ->where(['ConsumablePrices.consumable_id' => $consumablePrice->consumable_id]);

        foreach($oldConsumablePrices as $oldConsumablePrice) {
            $oldConsumablePrice->set('is_current', false);
            $this->getTableLocator()->get('ConsumablePrices')->save($oldConsumablePrice);
        }

        $consumablePrice->set('is_current', true);
        return $this->getTableLocator()->get('ConsumablePrices')->save($consumablePrice);
    }
}