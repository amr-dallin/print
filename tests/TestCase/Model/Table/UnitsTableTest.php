<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UnitsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UnitsTable Test Case
 */
class UnitsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UnitsTable
     */
    protected $Units;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Units',
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
        $config = $this->getTableLocator()->exists('Units') ? [] : ['className' => UnitsTable::class];
        $this->Units = $this->getTableLocator()->get('Units', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Units);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\UnitsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
