<?php
declare(strict_types=1);

namespace App\Service;

use Cake\I18n\FrozenTime;
use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Locator\LocatorAwareTrait;

class PurchasesService
{
    use LocatorAwareTrait;

    public function approve($purchase)
    {
        foreach($purchase->purchase_entities as $purchaseEntity) {
            if ($purchaseEntity->amount <= 0) {
                return false;
            }
        }

        $purchase->set('status', PURCHASE_STATUS_APPROVED);
        return ($this->getTableLocator()->get('Purchases')->save($purchase)) ? true : false;
    }

    public function getRange($range = null)
    {
        $purchases = $this->getTableLocator()->get('Purchases')->find()
            ->contain([
                'PurchaseEntities',
                'Suppliers'
            ]);

        if (null !== $range) {
            list($date_from, $date_to) = explode(' - ', $range);
            $purchases->where(function (QueryExpression $exp) use ($date_from, $date_to) {
                return $exp->between('date_purchased', new FrozenTime($date_from), new FrozenTime($date_to));
            });
        }

        return $purchases->toArray();
    }
}