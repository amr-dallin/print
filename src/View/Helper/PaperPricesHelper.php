<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * PaperPrices helper
 */
class PaperPricesHelper extends Helper
{
    public $helpers = ['Html', 'Number'];

    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    public function isCurrent($paperPrice)
    {
        return ($paperPrice->is_current) ? true : false;
    }
}
