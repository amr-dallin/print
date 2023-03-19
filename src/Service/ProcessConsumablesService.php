<?php
declare(strict_types=1);

namespace App\Service;

use App\Service\OrdersService;
use Cake\ORM\Locator\LocatorAwareTrait;

class ProcessConsumablesService
{
    use LocatorAwareTrait;

    public function save($processConsumable)
    {
        $consumablePrice = $this->getTableLocator()->get('ConsumablePrices')->get($processConsumable->consumable_price_id);
        $processConsumable->set('cost_price', $this->getCostPrice($processConsumable, $consumablePrice));
        if ($this->getTableLocator()->get('ProcessConsumables')->save($processConsumable)) {
            $order = $this->getTableLocator()->get('Orders')->find()
                ->innerJoinWith('OrderProducts.ProductProcesses.ProcessConsumables', function ($q) use ($processConsumable) {
                    return $q->where([
                        'ProcessConsumables.id' => $processConsumable->id
                    ]);
                })
                ->firstOrFail();

            (new OrdersService())->cost($order->id);

            return true;
        }

        return false;
    }

    private function getCostPrice($processConsumable, $consumablePrice): string
    {
        return bcmul(
            (string)$processConsumable->quantity,
            (string)$consumablePrice->amount,
            4
        );
    }
}