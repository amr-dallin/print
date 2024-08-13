<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Storage helper
 */
class StorageHelper extends Helper
{
    public $helpers = ['Html', 'Number'];

    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    public function availability($entity)
    {
        $quantity = (string)0;
        foreach($entity->purchase_entities as $purchaseEntity) {
            $quantity = bcadd($quantity, (string)$purchaseEntity->quantity, 2);
        }

        $quantityExpense = (string)0;
        foreach($entity->expenses as $expense) {
            $quantity = bcsub($quantity, (string)$expense->quantity, 2);
        }

        return $quantity;
    }
}
