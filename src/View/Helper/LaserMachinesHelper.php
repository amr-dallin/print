<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * LaserMachines helper
 */
class LaserMachinesHelper extends Helper
{
    public $helpers = ['Html', 'Number'];

    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    public function isActive($is_active)
    {
        return ($is_active) ? true : false;
    }

    public function isFullColorType($type)
    {
        return ($type === LASER_MACHINE_FULL_COLOR_TYPE) ? true : false;
    }

    public function isMonochromeType($type)
    {
        return ($type === LASER_MACHINE_MONOCHROME_TYPE) ? true : false;
    }

    public function listOfTypes()
    {
        return [
            LASER_MACHINE_MONOCHROME_TYPE => __('Monochrome'),
            LASER_MACHINE_FULL_COLOR_TYPE => __('Full color')
        ];
    }

    public function typeIcon($type)
    {
        switch($type) {
            case LASER_MACHINE_MONOCHROME_TYPE:
                return $this->Html->tag('span', $this->listOfTypes()[LASER_MACHINE_MONOCHROME_TYPE], ['class' => 'badge badge-grey']);
                break;
            case LASER_MACHINE_FULL_COLOR_TYPE:
                return $this->Html->tag('span', $this->listOfTypes()[LASER_MACHINE_FULL_COLOR_TYPE], ['class' => 'badge badge-success']);
                break;
        }
    }
}
