<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PhoneNumbersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PhoneNumbersTable Test Case
 */
class PhoneNumbersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PhoneNumbersTable
     */
    protected $PhoneNumbers;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.PhoneNumbers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('PhoneNumbers') ? [] : ['className' => PhoneNumbersTable::class];
        $this->PhoneNumbers = $this->getTableLocator()->get('PhoneNumbers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->PhoneNumbers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PhoneNumbersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PhoneNumbersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
