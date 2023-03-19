<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PaperDensitiesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PaperDensitiesTable Test Case
 */
class PaperDensitiesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PaperDensitiesTable
     */
    protected $PaperDensities;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.PaperDensities',
        'app.Papers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('PaperDensities') ? [] : ['className' => PaperDensitiesTable::class];
        $this->PaperDensities = $this->getTableLocator()->get('PaperDensities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->PaperDensities);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PaperDensitiesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PaperDensitiesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
