<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductTypesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductTypesTable Test Case
 */
class ProductTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProductTypesTable
     */
    protected $ProductTypes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ProductTypes',
        'app.OrderProducts',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ProductTypes') ? [] : ['className' => ProductTypesTable::class];
        $this->ProductTypes = $this->getTableLocator()->get('ProductTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ProductTypes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ProductTypesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
