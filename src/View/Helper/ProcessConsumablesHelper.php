<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * ProcessConsumables helper
 */
class ProcessConsumablesHelper extends Helper
{
    public $helpers = ['Html', 'Number'];

    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    public function costPrice($processConsumable)
    {
        return bcmul(
            $processConsumable->consumable_price->amount,
            (string)$processConsumable->quantity,
            4
        );
    }
}
