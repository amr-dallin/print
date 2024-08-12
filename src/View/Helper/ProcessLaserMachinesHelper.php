<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * ProcessLaserMachines helper
 */
class ProcessLaserMachinesHelper extends Helper
{
    public $helpers = ['Html', 'Number'];

    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    public function listOfPrintTypes()
    {
        return [
            PROCESS_LASER_MACHINES_PRINT_TYPE_4_0 => '4 + 0',
            PROCESS_LASER_MACHINES_PRINT_TYPE_4_4 => '4 + 4',
            PROCESS_LASER_MACHINES_PRINT_TYPE_1_0 => '1 + 0',
            PROCESS_LASER_MACHINES_PRINT_TYPE_1_1 => '1 + 1',
            PROCESS_LASER_MACHINES_PRINT_TYPE_4_1 => '4 + 1',
        ];
    }

    public function isFullColor($processLaserMachine)
    {
        switch ($processLaserMachine->print_type) {
            case PROCESS_LASER_MACHINES_PRINT_TYPE_4_0:
            case PROCESS_LASER_MACHINES_PRINT_TYPE_4_4:
            case PROCESS_LASER_MACHINES_PRINT_TYPE_4_1:
                return true;

            default:
                return false;
        }
    }

    public function isMonochrome($processLaserMachine)
    {
        switch ($processLaserMachine->print_type) {
            case PROCESS_LASER_MACHINES_PRINT_TYPE_1_0:
            case PROCESS_LASER_MACHINES_PRINT_TYPE_1_1:
                return true;

            default:
                return false;
        }
    }
}
