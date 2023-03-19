<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PaperPricesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PaperPricesTable Test Case
 */
class PaperPricesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PaperPricesTable
     */
    protected $PaperPrices;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.PaperPrices',
        'app.Papers',
        'app.ProcessPapers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('PaperPrices') ? [] : ['className' => PaperPricesTable::class];
        $this->PaperPrices = $this->getTableLocator()->get('PaperPrices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->PaperPrices);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PaperPricesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PaperPricesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
