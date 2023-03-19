<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * PaperDensities helper
 */
class PaperDensitiesHelper extends Helper
{
    public $helpers = ['Html', 'Number'];

    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    public function title($density)
    {
        return __('{0} gr/m{1}', $density, $this->Html->tag('sup', '2'));
    }
}
