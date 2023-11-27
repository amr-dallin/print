<?php
declare(strict_types=1);

namespace App\Service;

use Cake\I18n\FrozenTime;
use Cake\ORM\Locator\LocatorAwareTrait;

class ProcessLaserMachinesService
{
    use LocatorAwareTrait;

    public function getCostPrice($processLaserMachine): string
    {
        $laserMachineRate = $this->getTableLocator()->get('LaserMachineRates')->get($processLaserMachine->laser_machine_rate_id);
        $costPrice = (string)0;
        switch ($processLaserMachine->print_type) {
            case PROCESS_LASER_MACHINES_PRINT_TYPE_4_0:
            case PROCESS_LASER_MACHINES_PRINT_TYPE_4_4:
                $costPrice = $this->fullColorCalculate(
                    $laserMachineRate,
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
                    $laserMachineRate,
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
                    $laserMachineRate,
                    [
                        'pouring' => $processLaserMachine->pouring,
                        'size' => $processLaserMachine->width *
                            $processLaserMachine->height *
                            ($processLaserMachine->number_of_pages / 2) *
                            $processLaserMachine->number_of_copies
                    ]
                );
                $costPriceMonochrome = $this->fullColorCalculate(
                    $laserMachineRate,
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
}