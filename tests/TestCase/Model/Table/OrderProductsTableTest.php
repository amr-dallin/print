<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrderProductsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrderProductsTable Test Case
 */
class OrderProductsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrderProductsTable
     */
    protected $OrderProducts;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.OrderProducts',
        'app.Contractors',
        'app.Orders',
        'app.ProductTypes',
        'app.ProductProcesses',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('OrderProducts') ? [] : ['className' => OrderProductsTable::class];
        $this->OrderProducts = $this->getTableLocator()->get('OrderProducts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->OrderProducts);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\OrderProductsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\OrderProductsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
