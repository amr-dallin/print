<?php
declare(strict_types=1);

namespace App\Service;

use Cake\I18n\FrozenTime;
use Cake\ORM\Locator\LocatorAwareTrait;

class OpCollectionsService
{
    use LocatorAwareTrait;

    public function save($opCollection)
    {
        $opServices = $this->getTableLocator()->get('OpServices')->find('isNullCollection')
            ->order(['OpServices.date_of_service' => 'asc'])
            ->where(['OpServices.date_of_service <' => $opCollection->date_collection])
            ->toArray();

        if (empty($opServices)) {
            return false;
        }

        $opCollection->set('date_from', $opServices[0]->date_of_service);
        $opCollection->set('date_to', $opServices[(count($opServices) - 1)]->date_of_service);
        $opCollection->set('op_services', $opServices);

        if ($this->getTableLocator()->get('OpCollections')->save($opCollection)) {
            return true;
        }
        return false;
    }
}