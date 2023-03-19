<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OpReceiptsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OpReceiptsTable Test Case
 */
class OpReceiptsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OpReceiptsTable
     */
    protected $OpReceipts;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.OpReceipts',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('OpReceipts') ? [] : ['className' => OpReceiptsTable::class];
        $this->OpReceipts = $this->getTableLocator()->get('OpReceipts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->OpReceipts);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\OpReceiptsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
