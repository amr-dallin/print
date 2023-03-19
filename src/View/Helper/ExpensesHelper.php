<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Expenses helper
 */
class ExpensesHelper extends Helper
{
    public $helpers = ['Html', 'Number'];

    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    public function isPaper($model)
    {
        return ($model === 'Papers') ? true : false;
    }

    public function isConsumable($model)
    {
        return ($model === 'Consumables') ? true : false;
    }
}
