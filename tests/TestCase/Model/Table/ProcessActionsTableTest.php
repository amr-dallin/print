<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProcessActionsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProcessActionsTable Test Case
 */
class ProcessActionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProcessActionsTable
     */
    protected $ProcessActions;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ProcessActions',
        'app.ActionPrices',
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
        $config = $this->getTableLocator()->exists('ProcessActions') ? [] : ['className' => ProcessActionsTable::class];
        $this->ProcessActions = $this->getTableLocator()->get('ProcessActions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ProcessActions);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ProcessActionsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ProcessActionsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
