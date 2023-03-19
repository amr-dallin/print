<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProcessConnectionsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProcessConnectionsTable Test Case
 */
class ProcessConnectionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProcessConnectionsTable
     */
    protected $ProcessConnections;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ProcessConnections',
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
        $config = $this->getTableLocator()->exists('ProcessConnections') ? [] : ['className' => ProcessConnectionsTable::class];
        $this->ProcessConnections = $this->getTableLocator()->get('ProcessConnections', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ProcessConnections);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ProcessConnectionsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ProcessConnectionsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
