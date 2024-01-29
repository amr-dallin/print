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
        $size = (string)0;
        switch ($processLaserMachine->print_type) {
            case PROCESS_LASER_MACHINES_PRINT_TYPE_4_0:
            case PROCESS_LASER_MACHINES_PRINT_TYPE_4_4:
                $size = $this->plainSize($processLaserMachine);
                $costPrice = $this->fullColorCalculate(
                    $processLaserMachine,
                    $laserMachineRate
                );
                break;
            case PROCESS_LASER_MACHINES_PRINT_TYPE_1_0:
            case PROCESS_LASER_MACHINES_PRINT_TYPE_1_1:
                $size = $this->plainSize($processLaserMachine);
                $costPrice = $this->monochromeCalculate(
                    $processLaserMachine,
                    $laserMachineRate
                );
                break;
            case PROCESS_LASER_MACHINES_PRINT_TYPE_4_1:
                $size = $this->colorful($processLaserMachine);
                $costPriceFullColor = $this->fullColorCalculate(
                    $processLaserMachine,
                    $laserMachineRate
                );
                $costPriceMonochrome = $this->monochromeCalculate(
                    $processLaserMachine,
                    $laserMachineRate
                );
                $costPrice = bcadd($costPriceFullColor, $costPriceMonochrome, 4);
                break;
        }

        $costPrice = $this->ratioSize($costPrice, $size, $laserMachineRate->default_size);
        $costPrice = $this->extra($costPrice, $laserMachineRate->extra);

        return $costPrice;
    }

    private function fullColorCalculate($processLaserMachine, $laserMachineRate): string
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

    private function monochromeCalculate($processLaserMachine, $laserMachineRate): string
    {
        $pouringK = bcdiv((string)$processLaserMachine->pouring_k, (string)$laserMachineRate->default_pouring, 4);

        $tonerK = bcmul((string)$laserMachineRate->toner_k_p, (string)$pouringK, 4);

        $price = (string)0;
        $price = bcadd($price, (string)$tonerK, 4);
        $price = bcadd($price, (string)$laserMachineRate->drum_k_p, 4);
        $price = bcadd($price, (string)$laserMachineRate->developer_k_p, 4);

        return $price;
    }

    private function ratioSize($price, $size, $defaultSize): string
    {
        $ratioSize = bcdiv((string)$size, (string)$defaultSize, 4);

        return bcmul((string)$price, (string)$ratioSize, 4);
    }

    private function plainSize($processLaserMachine)
    {
        return $processLaserMachine->width *
            $processLaserMachine->height *
            $processLaserMachine->number_of_pages *
            $processLaserMachine->number_of_copies;
    }

    private function colorful($processLaserMachine)
    {
        return $processLaserMachine->width *
            $processLaserMachine->height *
            ($processLaserMachine->number_of_pages / 2) *
            $processLaserMachine->number_of_copies;
    }

    private function extra($price, $extra): string
    {
        if ((null !== $extra) && $extra > 0) {
            $price = bcadd($price, bcdiv(bcmul($price, (string)$extra, 4), (string)100, 4), 4);
        }

        return $price;
    }








    public function getOldCostPrice($processLaserMachine): string
    {
        $laserMachineRate = $this->getTableLocator()->get('LaserMachineRates')->get($processLaserMachine->laser_machine_rate_id);
        $costPrice = (string)0;
        switch ($processLaserMachine->print_type) {
            case PROCESS_LASER_MACHINES_PRINT_TYPE_4_0:
            case PROCESS_LASER_MACHINES_PRINT_TYPE_4_4:
                $costPrice = $this->oldfullColorCalculate(
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
                $costPrice = $this->oldmonochromeCalculate(
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
                $costPriceFullColor = $this->oldfullColorCalculate(
                    $laserMachineRate,
                    [
                        'pouring' => $processLaserMachine->pouring,
                        'size' => $processLaserMachine->width *
                            $processLaserMachine->height *
                            ($processLaserMachine->number_of_pages / 2) *
                            $processLaserMachine->number_of_copies
                    ]
                );
                $costPriceMonochrome = $this->oldfullColorCalculate(
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

    private function oldextra($price, $extra): string
    {
        if ((null !== $extra) && $extra > 0) {
            $price = bcadd($price, bcdiv(bcmul($price, (string)$extra, 4), (string)100, 4), 4);
        }

        return $price;
    }

    private function oldfullColorCalculate($laserMachineRate, $data): string
    {
        $toner = (string)0;
        $toner = bcadd($toner, (string)$laserMachineRate->toner_c_p, 4);
        $toner = bcadd($toner, (string)$laserMachineRate->toner_m_p, 4);
        $toner = bcadd($toner, (string)$laserMachineRate->toner_y_p, 4);
        $toner = bcadd($toner, (string)$laserMachineRate->toner_k_p, 4);
        $toner = bcmul(
            $toner,
            $this->oldmulRatioPouringAndSize($laserMachineRate, $data),
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
            $this->oldratioSize($laserMachineRate, $data),
            4
        );

        $price = (string)0;
        $price = bcadd($toner, $drumAndDeveloper, 4);
        $price = $this->oldextra($price, $laserMachineRate->extra);

        return $price;
    }

    private function oldmonochromeCalculate($laserMachineRate, $data): string
    {
        $tonerK = bcmul(
            $this->oldmulRatioPouringAndSize($laserMachineRate, $data),
            (string)$laserMachineRate->toner_k_p,
            4
        );

        $drumAndDeveloperK = bcmul(
            $this->oldratioSize($laserMachineRate, $data),
            bcadd(
                (string)$laserMachineRate->developer_k_p,
                (string)$laserMachineRate->drum_k_p,
                4
            ),
            4
        );

        $price = (string)0;
        $price = bcadd($tonerK, $drumAndDeveloperK, 4);
        $price = $this->oldextra($price, $laserMachineRate->extra);

        return $price;
    }

    private function oldmulRatioPouringAndSize($laserMachineRate, $data): string
    {
        return bcmul(
            $this->oldratioPouring($laserMachineRate, $data),
            $this->oldratioSize($laserMachineRate, $data),
            4
        );
    }

    private function oldratioPouring($laserMachineRate, $data): string
    {
        return bcdiv((string)$data['pouring'], (string)$laserMachineRate->default_pouring, 4);
    }

    private function oldratioSize($laserMachineRate, $data): string
    {
        return bcdiv(
            (string)$data['size'],
            (string)$laserMachineRate->default_size,
            4
        );
    }

}