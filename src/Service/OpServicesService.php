<?php
declare(strict_types=1);

namespace App\Service;

use Cake\I18n\FrozenTime;
use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Locator\LocatorAwareTrait;

class OpServicesService
{
    use LocatorAwareTrait;

    public function getAnalitics($range = null)
    {
        if (null === $range) {
            return $this->getTableLocator()->get('OpServices')->find()
                ->where([
                    'OpServices.date_of_service' => FrozenTime::now()
                ])
                ->toArray();
        }

        list($date_from, $date_to) = explode(' - ', $range);
        return $this->getTableLocator()->get('OpServices')->find()
            ->where(function (QueryExpression $exp) use ($date_from, $date_to) {
                return $exp->between('date_of_service', new FrozenTime($date_from), new FrozenTime($date_to));
            })
            ->toArray();
    }
}