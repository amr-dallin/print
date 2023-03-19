<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LaserMachineRatesFixture
 */
class LaserMachineRatesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'laser_machine_id' => 1,
                'default_pouring' => 1,
                'default_size' => 1,
                'toner_c_p' => 1.5,
                'toner_m_p' => 1.5,
                'toner_y_p' => 1.5,
                'toner_k_p' => 1.5,
                'drum_c_p' => 1.5,
                'drum_m_p' => 1.5,
                'drum_y_p' => 1.5,
                'drum_k_p' => 1.5,
                'developer_c_p' => 1.5,
                'developer_m_p' => 1.5,
                'developer_y_p' => 1.5,
                'developer_k_p' => 1.5,
                'extra' => 1,
                'is_current' => 1,
                'date_commited' => '2023-01-31 16:17:12',
                'date_created' => '2023-01-31 16:17:12',
                'date_modified' => '2023-01-31 16:17:12',
            ],
        ];
        parent::init();
    }
}
