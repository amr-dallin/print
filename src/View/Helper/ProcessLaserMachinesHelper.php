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

    public function costPrice($processLaserMachine): string
    {
        $costPrice = (string)0;
        if (null !== $processLaserMachine->pouring) {
            $costPrice = $this->oldCostPrice($processLaserMachine);
        } else {
            $costPrice = $this->newCostPrice($processLaserMachine);
        }

        return $costPrice;
    }

    private function oldCostPrice($processLaserMachine): string
    {
        $costPrice = (string)0;
        switch ($processLaserMachine->print_type) {
            case PROCESS_LASER_MACHINES_PRINT_TYPE_4_0:
            case PROCESS_LASER_MACHINES_PRINT_TYPE_4_4:
                $costPrice = $this->fullColorCalculate(
                    $processLaserMachine->laser_machine_rate,
                    [
                        'pouring' => $processLaserMachine->pouring,
                        'size' => $processLaserMachine->width *
                            $processLaserMachine->height *
                            $processLaserMachine->number_of_pages *
                            $processLaserMachine->number_of_copies
                    ]
                );
                break;
            case PROCESS_LASER_MACHINES_PRINT_TYPE_1_0:
            case PROCESS_LASER_MACHINES_PRINT_TYPE_1_1:
                $costPrice = $this->monochromeCalculate(
                    $processLaserMachine->laser_machine_rate,
                    [
                        'pouring' => $processLaserMachine->pouring,
                        'size' => $processLaserMachine->width *
                            $processLaserMachine->height *
                            $processLaserMachine->number_of_pages *
                            $processLaserMachine->number_of_copies
                    ]
                );
                break;
            case PROCESS_LASER_MACHINES_PRINT_TYPE_4_1:
                $costPriceFullColor = $this->fullColorCalculate(
                    $processLaserMachine->laser_machine_rate,
                    [
                        'pouring' => $processLaserMachine->pouring,
                        'size' => $processLaserMachine->width *
                            $processLaserMachine->height *
                            ($processLaserMachine->number_of_pages / 2) *
                            $processLaserMachine->number_of_copies
                    ]
                );
                $costPriceMonochrome = $this->fullColorCalculate(
                    $processLaserMachine->laser_machine_rate,
                    [
                        'pouring' => $processLaserMachine->pouring,
                        'size' => $processLaserMachine->width *
                            $processLaserMachine->height *
                            ($processLaserMachine->number_of_pages / 2) *
                            $processLaserMachine->number_of_copies
                    ]
                );
                $costPrice = bcadd($costPriceFullColor, $costPriceMonochrome, 4);
                break;
        }

        return $costPrice;
    }

    private function extra($price, $extra): string
    {
        if ((null !== $extra) && $extra > 0) {
            $price = bcadd($price, bcdiv(bcmul($price, (string)$extra, 4), (string)100, 4), 4);
        }

        return $price;
    }

    private function fullColorCalculate($laserMachineRate, $data): string
    {
        $toner = (string)0;
        $toner = bcadd($toner, (string)$laserMachineRate->toner_c_p, 4);
        $toner = bcadd($toner, (string)$laserMachineRate->toner_m_p, 4);
        $toner = bcadd($toner, (string)$laserMachineRate->toner_y_p, 4);
        $toner = bcadd($toner, (string)$laserMachineRate->toner_k_p, 4);
        $toner = bcmul(
            $toner,
            $this->mulRatioPouringAndSize($laserMachineRate, $data),
            4
        );

        $drumAndDeveloper = (string)0;
        $drumAndDeveloper = bcadd($drumAndDeveloper, (string)$laserMachineRate->drum_c_p, 4);
        $drumAndDeveloper = bcadd($drumAndDeveloper, (string)$laserMachineRate->drum_m_p, 4);
        $drumAndDeveloper = bcadd($drumAndDeveloper, (string)$laserMachineRate->drum_y_p, 4);
        $drumAndDeveloper = bcadd($drumAndDeveloper, (string)$laserMachineRate->drum_k_p, 4);
        $drumAndDeveloper = bcadd($drumAndDeveloper, (string)$laserMachineRate->developer_c_p, 4);
        $drumAndDeveloper = bcadd($drumAndDeveloper, (string)$laserMachineRate->developer_m_p, 4);
        $drumAndDeveloper = bcadd($drumAndDeveloper, (string)$laserMachineRate->developer_y_p, 4);
        $drumAndDeveloper = bcadd($drumAndDeveloper, (string)$laserMachineRate->developer_k_p, 4);
        $drumAndDeveloper = bcmul(
            $drumAndDeveloper,
            $this->ratioSize($laserMachineRate, $data),
            4
        );

        $price = (string)0;
        $price = bcadd($toner, $drumAndDeveloper, 4);
        $price = $this->extra($price, $laserMachineRate->extra);

        return $price;
    }

    private function monochromeCalculate($laserMachineRate, $data): string
    {
        $tonerK = bcmul(
            $this->mulRatioPouringAndSize($laserMachineRate, $data),
            (string)$laserMachineRate->toner_k_p,
            4
        );

        $drumAndDeveloperK = bcmul(
            $this->ratioSize($laserMachineRate, $data),
            bcadd(
                (string)$laserMachineRate->developer_k_p,
                (string)$laserMachineRate->drum_k_p,
                4
            ),
            4
        );

        $price = (string)0;
        $price = bcadd($tonerK, $drumAndDeveloperK, 4);
        $price = $this->extra($price, $laserMachineRate->extra);

        return $price;
    }

    private function mulRatioPouringAndSize($laserMachineRate, $data): string
    {
        return bcmul(
            $this->ratioPouring($laserMachineRate, $data),
            $this->ratioSize($laserMachineRate, $data),
            4
        );
    }

    private function ratioPouring($laserMachineRate, $data): string
    {
        return bcdiv((string)$data['pouring'], (string)$laserMachineRate->default_pouring, 4);
    }

    private function ratioSize($laserMachineRate, $data): string
    {
        return bcdiv(
            (string)$data['size'],
            (string)$laserMachineRate->default_size,
            4
        );
    }





    private function newCostPrice($processLaserMachine): string
    {
        $costPrice = (string)0;
        $size = (string)0;
        switch ($processLaserMachine->print_type) {
            case PROCESS_LASER_MACHINES_PRINT_TYPE_4_0:
            case PROCESS_LASER_MACHINES_PRINT_TYPE_4_4:
                $size = $this->newPlainSize($processLaserMachine);
                $costPrice = $this->newFullColorCalculate(
                    $processLaserMachine,
                    $processLaserMachine->laser_machine_rate
                );
                break;
            case PROCESS_LASER_MACHINES_PRINT_TYPE_1_0:
            case PROCESS_LASER_MACHINES_PRINT_TYPE_1_1:
                $size = $this->newPlainSize($processLaserMachine);
                $costPrice = $this->newMonochromeCalculate(
                    $processLaserMachine,
                    $processLaserMachine->laser_machine_rate
                );
                break;
            case PROCESS_LASER_MACHINES_PRINT_TYPE_4_1:
                $size = $this->newColorful($processLaserMachine);
                $costPriceFullColor = $this->newFullColorCalculate(
                    $processLaserMachine,
                    $processLaserMachine->laser_machine_rate
                );
                $costPriceMonochrome = $this->newMonochromeCalculate(
                    $processLaserMachine,
                    $processLaserMachine->laser_machine_rate
                );
                $costPrice = bcadd($costPriceFullColor, $costPriceMonochrome, 4);
                break;
        }

        $costPrice = $this->newRatioSize($costPrice, $size, $processLaserMachine->laser_machine_rate->default_size);
        $costPrice = $this->newExtra($costPrice, $processLaserMachine->laser_machine_rate->extra);

        return $costPrice;
    }

    private function newFullColorCalculate($processLaserMachine, $laserMachineRate): string
    {
        $pouringC = bcdiv((string)$processLaserMachine->pouring_c, (string)$laserMachineRate->default_pouring, 4);
        $pouringM = bcdiv((string)$processLaserMachine->pouring_m, (string)$laserMachineRate->default_pouring, 4);
        $pouringY = bcdiv((string)$processLaserMachine->pouring_y, (string)$laserMachineRate->default_pouring, 4);
        $pouringK = bcdiv((string)$processLaserMachine->pouring_k, (string)$laserMachineRate->default_pouring, 4);

        $tonerC = bcmul((string)$laserMachineRate->toner_c_p, (string)$pouringC, 4);
        $tonerM = bcmul((string)$laserMachineRate->toner_m_p, (string)$pouringM, 4);
        $tonerY = bcmul((string)$laserMachineRate->toner_y_p, (string)$pouringY, 4);
        $tonerK = bcmul((string)$laserMachineRate->toner_k_p, (string)$pouringK, 4);

        $price = (string)0;
        $price = bcadd($price, (string)$tonerC, 4);
        $price = bcadd($price, (string)$tonerM, 4);
        $price = bcadd($price, (string)$tonerY, 4);
        $price = bcadd($price, (string)$tonerK, 4);
        $price = bcadd($price, (string)$laserMachineRate->drum_c_p, 4);
        $price = bcadd($price, (string)$laserMachineRate->drum_m_p, 4);
        $price = bcadd($price, (string)$laserMachineRate->drum_y_p, 4);
        $price = bcadd($price, (string)$laserMachineRate->drum_k_p, 4);
        $price = bcadd($price, (string)$laserMachineRate->developer_c_p, 4);
        $price = bcadd($price, (string)$laserMachineRate->developer_m_p, 4);
        $price = bcadd($price, (string)$laserMachineRate->developer_y_p, 4);
        $price = bcadd($price, (string)$laserMachineRate->developer_k_p, 4);

        return $price;
    }

    private function newMonochromeCalculate($processLaserMachine, $laserMachineRate): string
    {
        $pouringK = bcdiv((string)$processLaserMachine->pouring_k, (string)$laserMachineRate->default_pouring, 4);

        $tonerK = bcmul((string)$laserMachineRate->toner_k_p, (string)$pouringK, 4);

        $price = (string)0;
        $price = bcadd($price, (string)$tonerK, 4);
        $price = bcadd($price, (string)$laserMachineRate->drum_k_p, 4);
        $price = bcadd($price, (string)$laserMachineRate->developer_k_p, 4);

        return $price;
    }

    private function newRatioSize($price, $size, $defaultSize): string
    {
        $ratioSize = bcdiv((string)$size, (string)$defaultSize, 4);

        return bcmul((string)$price, (string)$ratioSize, 4);
    }

    private function newPlainSize($processLaserMachine)
    {
        return $processLaserMachine->width *
            $processLaserMachine->height *
            $processLaserMachine->number_of_pages *
            $processLaserMachine->number_of_copies;
    }

    private function newColorful($processLaserMachine)
    {
        return $processLaserMachine->width *
            $processLaserMachine->height *
            ($processLaserMachine->number_of_pages / 2) *
            $processLaserMachine->number_of_copies;
    }

    private function newExtra($price, $extra): string
    {
        if ((null !== $extra) && $extra > 0) {
            $price = bcadd($price, bcdiv(bcmul($price, (string)$extra, 4), (string)100, 4), 4);
        }

        return $price;
    }
}
