<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * ActionPrices helper
 */
class ActionPricesHelper extends Helper
{
    public $helpers = ['Html', 'Number'];

    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    public function isCurrent($actionPrice)
    {
        return ($actionPrice->is_current) ? true : false;
    }
}
