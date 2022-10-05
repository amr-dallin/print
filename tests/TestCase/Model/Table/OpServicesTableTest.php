<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OpServicesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OpServicesTable Test Case
 */
class OpServicesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OpServicesTable
     */
    protected $OpServices;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.OpServices',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('OpServices') ? [] : ['className' => OpServicesTable::class];
        $this->OpServices = $this->getTableLocator()->get('OpServices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->OpServices);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\OpServicesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
