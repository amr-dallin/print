<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RepresentativesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RepresentativesTable Test Case
 */
class RepresentativesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RepresentativesTable
     */
    protected $Representatives;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Representatives',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Representatives') ? [] : ['className' => RepresentativesTable::class];
        $this->Representatives = $this->getTableLocator()->get('Representatives', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Representatives);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\RepresentativesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
