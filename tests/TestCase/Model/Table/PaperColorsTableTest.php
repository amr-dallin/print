<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PaperColorsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PaperColorsTable Test Case
 */
class PaperColorsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PaperColorsTable
     */
    protected $PaperColors;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.PaperColors',
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
        $config = $this->getTableLocator()->exists('PaperColors') ? [] : ['className' => PaperColorsTable::class];
        $this->PaperColors = $this->getTableLocator()->get('PaperColors', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->PaperColors);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PaperColorsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PaperColorsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
