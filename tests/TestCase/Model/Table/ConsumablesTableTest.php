<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConsumablesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConsumablesTable Test Case
 */
class ConsumablesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ConsumablesTable
     */
    protected $Consumables;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Consumables',
        'app.ConsumableCategories',
        'app.Units',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Consumables') ? [] : ['className' => ConsumablesTable::class];
        $this->Consumables = $this->getTableLocator()->get('Consumables', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Consumables);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ConsumablesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ConsumablesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
