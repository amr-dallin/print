<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProcessConnectionsFixture
 */
class ProcessConnectionsFixture extends TestFixture
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
                'parent_id' => 1,
                'process_id' => 1,
            ],
        ];
        parent::init();
    }
}
