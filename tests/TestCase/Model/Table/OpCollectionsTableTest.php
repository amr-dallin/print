<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OpCollectionsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OpCollectionsTable Test Case
 */
class OpCollectionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OpCollectionsTable
     */
    protected $OpCollections;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.OpCollections',
        'app.OpServices',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('OpCollections') ? [] : ['className' => OpCollectionsTable::class];
        $this->OpCollections = $this->getTableLocator()->get('OpCollections', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->OpCollections);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\OpCollectionsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
