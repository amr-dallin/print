<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProcessPapersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProcessPapersTable Test Case
 */
class ProcessPapersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProcessPapersTable
     */
    protected $ProcessPapers;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ProcessPapers',
        'app.PaperPrices',
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
        $config = $this->getTableLocator()->exists('ProcessPapers') ? [] : ['className' => ProcessPapersTable::class];
        $this->ProcessPapers = $this->getTableLocator()->get('ProcessPapers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ProcessPapers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ProcessPapersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ProcessPapersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
