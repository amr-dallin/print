<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductProcessesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductProcessesTable Test Case
 */
class ProductProcessesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProductProcessesTable
     */
    protected $ProductProcesses;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ProductProcesses',
        'app.Contractors',
        'app.OrderProducts',
        'app.ProcessActions',
        'app.ProcessConsumables',
        'app.ProcessLaserMachines',
        'app.ProcessPapers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ProductProcesses') ? [] : ['className' => ProductProcessesTable::class];
        $this->ProductProcesses = $this->getTableLocator()->get('ProductProcesses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ProductProcesses);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ProductProcessesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ProductProcessesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
