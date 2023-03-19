<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;
use App\Service\StorageService;

/**
 * Storage Controller
 */
class StorageController extends AppController
{
    public function availabilityConsumables(StorageService $storage)
    {
        $absentConsumables = $storage->getAbsentConsumables();
        $availableConsumables = $storage->getAvailableConsumables();
        $this->set(compact('absentConsumables', 'availableConsumables'));
    }

    public function availabilityPapers(StorageService $storage)
    {
        $absentPapers = $storage->getAbsentPapers();
        $availablePapers = $storage->getAvailablePapers();
        $this->set(compact('absentPapers', 'availablePapers'));
    }
}
