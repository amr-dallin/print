<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProcessPapersFixture
 */
class ProcessPapersFixture extends TestFixture
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
                'paper_price_id' => 1,
                'product_process_id' => 1,
                'quantity' => 1,
                'date_created' => '2023-03-11 17:11:19',
                'date_modified' => '2023-03-11 17:11:19',
            ],
        ];
        parent::init();
    }
}
