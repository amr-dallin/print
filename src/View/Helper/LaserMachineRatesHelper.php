<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * LaserMachineRates helper
 */
class LaserMachineRatesHelper extends Helper
{
    public $helpers = ['Html', 'Number'];

    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    public function defaultFullColorPrice($laserMachineRate)
    {
        $price = (string)0;
        $price = bcadd($price, (string)$laserMachineRate->toner_c_p, 4);
        $price = bcadd($price, (string)$laserMachineRate->toner_m_p, 4);
        $price = bcadd($price, (string)$laserMachineRate->toner_y_p, 4);
        $price = bcadd($price, (string)$laserMachineRate->toner_k_p, 4);
        $price = bcadd($price, (string)$laserMachineRate->drum_c_p, 4);
        $price = bcadd($price, (string)$laserMachineRate->drum_m_p, 4);
        $price = bcadd($price, (string)$laserMachineRate->drum_y_p, 4);
        $price = bcadd($price, (string)$laserMachineRate->drum_k_p, 4);
        $price = bcadd($price, (string)$laserMachineRate->developer_c_p, 4);
        $price = bcadd($price, (string)$laserMachineRate->developer_m_p, 4);
        $price = bcadd($price, (string)$laserMachineRate->developer_y_p, 4);
        $price = bcadd($price, (string)$laserMachineRate->developer_k_p, 4);

        if ((null !== $laserMachineRate->extra) && $laserMachineRate->extra > 0) {
            $price = bcadd($price, bcdiv(bcmul($price, (string)$laserMachineRate->extra, 4), (string)100, 4));
        }

        return $price;
    }

    public function defaultMonochromePrice($laserMachineRate)
    {
        $price = (string)0;
        $price = bcadd($price, (string)$laserMachineRate->toner_k_p, 4);
        $price = bcadd($price, (string)$laserMachineRate->drum_k_p, 4);
        $price = bcadd($price, (string)$laserMachineRate->developer_k_p, 4);

        if ((null !== $laserMachineRate->extra) && $laserMachineRate->extra > 0) {
            $price = bcadd($price, bcdiv(bcmul($price, (string)$laserMachineRate->extra, 4), (string)100, 4));
        }

        return $price;
    }
}
