<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LaserMachineRatesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LaserMachineRatesTable Test Case
 */
class LaserMachineRatesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LaserMachineRatesTable
     */
    protected $LaserMachineRates;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.LaserMachineRates',
        'app.LaserMachines',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('LaserMachineRates') ? [] : ['className' => LaserMachineRatesTable::class];
        $this->LaserMachineRates = $this->getTableLocator()->get('LaserMachineRates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->LaserMachineRates);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LaserMachineRatesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LaserMachineRatesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
