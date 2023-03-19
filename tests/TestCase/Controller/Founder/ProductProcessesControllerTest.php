<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Founder;

use App\Controller\Founder\ProductProcessesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Founder\ProductProcessesController Test Case
 *
 * @uses \App\Controller\Founder\ProductProcessesController
 */
class ProductProcessesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.ProductProcesses',
        'app.Contractors',
        'app.OrderProducts',
        'app.ProcessActions',
        'app.ProcessConsumables',
        'app.ProcessLaserMachines',
        'app.ProcessPapers',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\Founder\ProductProcessesController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\Founder\ProductProcessesController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\Founder\ProductProcessesController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\Founder\ProductProcessesController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\Founder\ProductProcessesController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
