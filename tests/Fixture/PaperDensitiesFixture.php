<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PaperDensitiesFixture
 */
class PaperDensitiesFixture extends TestFixture
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
                'density' => 1,
                'date_created' => '2023-01-15 14:53:20',
                'date_modified' => '2023-01-15 14:53:20',
            ],
        ];
        parent::init();
    }
}
