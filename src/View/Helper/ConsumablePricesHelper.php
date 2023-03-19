<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * ConsumablePrices helper
 */
class ConsumablePricesHelper extends Helper
{
    public $helpers = ['Html', 'Number'];

    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    public function isCurrent($consumablePrice)
    {
        return ($consumablePrice->is_current) ? true : false;
    }
}
