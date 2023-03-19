<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PurchaseEntitiesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PurchaseEntitiesTable Test Case
 */
class PurchaseEntitiesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PurchaseEntitiesTable
     */
    protected $PurchaseEntities;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.PurchaseEntities',
        'app.Purchases',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('PurchaseEntities') ? [] : ['className' => PurchaseEntitiesTable::class];
        $this->PurchaseEntities = $this->getTableLocator()->get('PurchaseEntities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->PurchaseEntities);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PurchaseEntitiesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PurchaseEntitiesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
