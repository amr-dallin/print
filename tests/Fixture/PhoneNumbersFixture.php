<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PhoneNumbersFixture
 */
class PhoneNumbersFixture extends TestFixture
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
                'id' => '426ccf2c-605f-4316-b6bc-0bccac123eaf',
                'foreign_key' => '6d1288a0-b290-45ca-992c-ec3597a42f21',
                'model' => 'Lorem ipsum dolor sit amet',
                'number' => 'Lorem i',
                'is_telegram' => 1,
                'date_created' => '2023-03-11 13:33:54',
                'date_modified' => '2023-03-11 13:33:54',
            ],
        ];
        parent::init();
    }
}
