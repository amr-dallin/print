<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * ProcessPapers helper
 */
class ProcessPapersHelper extends Helper
{
    public $helpers = ['Html', 'Number'];

    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    public function title($processPaper)
    {
        return h($processPaper->paper_price->paper->full_name);
    }

    public function costPrice($processPaper)
    {
        return bcmul(
            $processPaper->paper_price->amount,
            (string)$processPaper->quantity,
            4
        );
    }
}
