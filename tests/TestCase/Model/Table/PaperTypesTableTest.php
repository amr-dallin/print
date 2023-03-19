<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PaperTypesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PaperTypesTable Test Case
 */
class PaperTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PaperTypesTable
     */
    protected $PaperTypes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.PaperTypes',
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
        $config = $this->getTableLocator()->exists('PaperTypes') ? [] : ['className' => PaperTypesTable::class];
        $this->PaperTypes = $this->getTableLocator()->get('PaperTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->PaperTypes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PaperTypesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
