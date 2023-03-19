<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LaserMachinesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LaserMachinesTable Test Case
 */
class LaserMachinesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LaserMachinesTable
     */
    protected $LaserMachines;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.LaserMachines',
        'app.LaserMachineRates',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('LaserMachines') ? [] : ['className' => LaserMachinesTable::class];
        $this->LaserMachines = $this->getTableLocator()->get('LaserMachines', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->LaserMachines);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LaserMachinesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
