<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PurchaseEntitiesFixture
 */
class PurchaseEntitiesFixture extends TestFixture
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
                'purchase_id' => 1,
                'foreign_key' => '5690f30a-6cdd-4e3b-b82f-dd15651ad28a',
                'model' => 'Lorem ipsum dolor sit amet',
                'quantity' => 1,
                'amount' => 1.5,
                'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'date_created' => '2023-01-15 14:54:16',
                'date_modified' => '2023-01-15 14:54:16',
            ],
        ];
        parent::init();
    }
}
