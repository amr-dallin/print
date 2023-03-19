<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProcessLaserMachinesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProcessLaserMachinesTable Test Case
 */
class ProcessLaserMachinesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProcessLaserMachinesTable
     */
    protected $ProcessLaserMachines;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ProcessLaserMachines',
        'app.LaserMachineRates',
        'app.ProductProcesses',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ProcessLaserMachines') ? [] : ['className' => ProcessLaserMachinesTable::class];
        $this->ProcessLaserMachines = $this->getTableLocator()->get('ProcessLaserMachines', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ProcessLaserMachines);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ProcessLaserMachinesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ProcessLaserMachinesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
