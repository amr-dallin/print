<?php
declare(strict_types=1);

namespace Panel\Test\TestCase\Controller\Founder;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Panel\Controller\Founder\ContractorsController;

/**
 * Panel\Controller\Founder\ContractorsController Test Case
 *
 * @uses \Panel\Controller\Founder\ContractorsController
 */
class ContractorsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'plugin.Panel.Contractors',
        'plugin.Panel.OrderProducts',
        'plugin.Panel.Orders',
        'plugin.Panel.ProductProcesses',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \Panel\Controller\Founder\ContractorsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \Panel\Controller\Founder\ContractorsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \Panel\Controller\Founder\ContractorsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \Panel\Controller\Founder\ContractorsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \Panel\Controller\Founder\ContractorsController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
