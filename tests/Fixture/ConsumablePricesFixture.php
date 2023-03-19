<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ConsumablePricesFixture
 */
class ConsumablePricesFixture extends TestFixture
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
                'consumable_id' => 1,
                'amount' => 1.5,
                'is_current' => 1,
                'date_commited' => '2023-03-10',
                'date_created' => '2023-03-10 03:03:05',
                'date_modified' => '2023-03-10 03:03:05',
            ],
        ];
        parent::init();
    }
}
