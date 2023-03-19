<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProductProcessesFixture
 */
class ProductProcessesFixture extends TestFixture
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
                'contractor_id' => 1,
                'order_product_id' => 1,
                'type' => 'Lorem ipsum dolor sit amet',
                'group_type' => 'Lorem ipsum dolor sit amet',
                'unique_id' => '',
                'contractor_full_name' => 'Lorem ipsum dolor sit amet',
                'contractor_telephone' => 'Lorem ipsum dolor sit amet',
                'title' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'total_cost' => 1.5,
                'status' => 'Lorem ipsum dolor sit amet',
                'status_message' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'date_completed' => '2023-03-11 17:10:59',
                'date_created' => '2023-03-11 17:10:59',
                'date_modified' => '2023-03-11 17:10:59',
            ],
        ];
        parent::init();
    }
}
