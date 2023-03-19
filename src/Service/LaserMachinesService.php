<?php
declare(strict_types=1);

namespace App\Service;

use Cake\I18n\FrozenTime;
use Cake\ORM\Locator\LocatorAwareTrait;

class LaserMachinesService
{
    use LocatorAwareTrait;

    public function calculate($laserMachine, $data): string
    {
        $price = (string)0;
        switch ($laserMachine->type) {
            case LASER_MACHINE_MONOCHROME_TYPE:
                $price = $this->monochromeCalculate($laserMachine->laser_machine_rates[0], $data);
                break;
            case LASER_MACHINE_FULL_COLOR_TYPE:
                $price = $this->fullColorCalculate($laserMachine->laser_machine_rates[0], $data);
                break;
        }

        return $price;
    }

    private function extra($price, $extra): string
    {
        if ((null !== $extra) && $extra > 0) {
            $price = bcadd($price, bcdiv(bcmul($price, (string)$extra, 4), (string)100, 4));
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

        $price = bcadd($toner, $drumAndDeveloper, 4);
        $price = $this->extra($price, $laserMachineRate->extra);

        return $price;
    }

    private function monochromeCalculate($laserMachineRate, $data): string
    {
        $price = (string)0;
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
            bcmul((string)$data['width'], (string)$data['height'], 4),
            (string)$laserMachineRate->default_size,
            4
        );
    }
}