<?php
declare(strict_types=1);

namespace App\Service;

use Cake\I18n\FrozenTime;
use Cake\ORM\Locator\LocatorAwareTrait;

class ProcessActionsService
{
    use LocatorAwareTrait;

    public function getCostPrice($processAction)
    {
        $actionPrice = $this->getTableLocator()->get('ActionPrices')->get($processAction->action_price_id);
        return bcmul(
            (string)$processAction->quantity,
            (string)$actionPrice->amount,
            4
        );
    }
}