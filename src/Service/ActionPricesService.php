<?php
declare(strict_types=1);

namespace App\Service;

use Cake\I18n\FrozenTime;
use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Locator\LocatorAwareTrait;

class ActionPricesService
{
    use LocatorAwareTrait;

    public function save($actionPrice)
    {
        $oldActionPrices = $this->getTableLocator()->get('ActionPrices')->find()
            ->where(['ActionPrices.action_id' => $actionPrice->action_id]);

        foreach($oldActionPrices as $oldActionPrice) {
            $oldActionPrice->set('is_current', false);
            $this->getTableLocator()->get('ActionPrices')->save($oldActionPrice);
        }

        $actionPrice->set('is_current', true);
        return $this->getTableLocator()->get('ActionPrices')->save($actionPrice);
    }
}