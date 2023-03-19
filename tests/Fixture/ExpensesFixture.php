<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ExpensesFixture
 */
class ExpensesFixture extends TestFixture
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
                'foreign_key' => '495fc8bb-53de-4d65-9344-6da2c00e36c3',
                'model' => 'Lorem ipsum dolor sit amet',
                'quantity' => 1,
                'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'date_expensed' => '2023-01-19',
                'date_created' => '2023-01-19 16:15:42',
                'date_modified' => '2023-01-19 16:15:42',
            ],
        ];
        parent::init();
    }
}
