<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * ProcessActions helper
 */
class ProcessActionsHelper extends Helper
{
    public $helpers = ['Html', 'Number'];

    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    public function costPrice($processAction)
    {
        return bcmul(
            (string)$processAction->quantity,
            (string)$processAction->action_price->amount,
            4
        );
    }
}
