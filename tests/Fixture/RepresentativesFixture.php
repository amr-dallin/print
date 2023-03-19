<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RepresentativesFixture
 */
class RepresentativesFixture extends TestFixture
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
                'id' => 'f5280aba-2faf-4fc4-801d-a2e86733d4f8',
                'foreign_key' => '93ade91e-fe38-48d2-99bc-32603603c516',
                'model' => 'Lorem ipsum dolor sit amet',
                'first_name' => 'Lorem ipsum dolor sit amet',
                'second_name' => 'Lorem ipsum dolor sit amet',
                'sur_name' => 'Lorem ipsum dolor sit amet',
                'date_created' => '2023-03-11 13:33:41',
                'date_modified' => '2023-03-11 13:33:41',
            ],
        ];
        parent::init();
    }
}
