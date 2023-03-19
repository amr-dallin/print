<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProcessLaserMachinesFixture
 */
class ProcessLaserMachinesFixture extends TestFixture
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
                'laser_machine_rate_id' => 1,
                'product_process_id' => 1,
                'number_of_copies' => 1,
                'number_of_pages' => 1,
                'width' => 1,
                'height' => 1,
                'print_type' => 'Lorem ipsum dolor sit amet',
                'pouring' => 1,
                'date_created' => '2023-03-11 17:11:42',
                'date_modified' => '2023-03-11 17:11:42',
            ],
        ];
        parent::init();
    }
}
