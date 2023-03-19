<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PapersFixture
 */
class PapersFixture extends TestFixture
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
                'paper_color_id' => 1,
                'paper_density_id' => 1,
                'paper_format_id' => 1,
                'paper_type_id' => 1,
                'initial_unit_id' => 1,
                'unit_id' => 1,
                'quantity' => 1,
                'title' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'date_created' => '2023-01-15 14:53:52',
                'date_modified' => '2023-01-15 14:53:52',
            ],
        ];
        parent::init();
    }
}
