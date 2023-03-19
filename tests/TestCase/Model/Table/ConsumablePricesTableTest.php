<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConsumablePricesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConsumablePricesTable Test Case
 */
class ConsumablePricesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ConsumablePricesTable
     */
    protected $ConsumablePrices;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ConsumablePrices',
        'app.Consumables',
        'app.ProcessConsumables',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ConsumablePrices') ? [] : ['className' => ConsumablePricesTable::class];
        $this->ConsumablePrices = $this->getTableLocator()->get('ConsumablePrices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ConsumablePrices);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ConsumablePricesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ConsumablePricesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
