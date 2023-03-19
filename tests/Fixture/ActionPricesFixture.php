<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ActionPricesFixture
 */
class ActionPricesFixture extends TestFixture
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
                'action_id' => 1,
                'amount' => 1.5,
                'is_current' => 1,
                'date_commited' => '2023-03-11',
                'date_created' => '2023-03-11 11:57:32',
                'date_modified' => '2023-03-11 11:57:32',
            ],
        ];
        parent::init();
    }
}
