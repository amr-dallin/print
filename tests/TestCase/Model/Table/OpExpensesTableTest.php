<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OpExpensesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OpExpensesTable Test Case
 */
class OpExpensesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OpExpensesTable
     */
    protected $OpExpenses;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.OpExpenses',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('OpExpenses') ? [] : ['className' => OpExpensesTable::class];
        $this->OpExpenses = $this->getTableLocator()->get('OpExpenses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->OpExpenses);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\OpExpensesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
