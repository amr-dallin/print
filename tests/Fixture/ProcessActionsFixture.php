<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProcessActionsFixture
 */
class ProcessActionsFixture extends TestFixture
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
                'action_price_id' => 1,
                'product_process_id' => 1,
                'quantity' => 1,
                'date_created' => '2023-03-11 17:11:46',
                'date_modified' => '2023-03-11 17:11:46',
            ],
        ];
        parent::init();
    }
}
