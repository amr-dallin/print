<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * PurchaseEntities helper
 */
class PurchaseEntitiesHelper extends Helper
{
    public $helpers = ['Html', 'Number'];

    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    public function total($purchaseEntity)
    {
        return bcmul(
            (string)$purchaseEntity->quantity,
            (string)$purchaseEntity->amount,
            4
        );
    }
}
