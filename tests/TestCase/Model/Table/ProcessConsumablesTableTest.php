<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProcessConsumablesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProcessConsumablesTable Test Case
 */
class ProcessConsumablesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProcessConsumablesTable
     */
    protected $ProcessConsumables;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ProcessConsumables',
        'app.ConsumablePrices',
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
        $config = $this->getTableLocator()->exists('ProcessConsumables') ? [] : ['className' => ProcessConsumablesTable::class];
        $this->ProcessConsumables = $this->getTableLocator()->get('ProcessConsumables', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ProcessConsumables);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ProcessConsumablesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ProcessConsumablesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
