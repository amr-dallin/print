<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ActionPricesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ActionPricesTable Test Case
 */
class ActionPricesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ActionPricesTable
     */
    protected $ActionPrices;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ActionPrices',
        'app.Actions',
        'app.ProcessActions',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ActionPrices') ? [] : ['className' => ActionPricesTable::class];
        $this->ActionPrices = $this->getTableLocator()->get('ActionPrices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ActionPrices);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ActionPricesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ActionPricesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
