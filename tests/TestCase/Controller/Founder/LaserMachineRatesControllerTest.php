<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Founder;

use App\Controller\Founder\LaserMachineRatesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Founder\LaserMachineRatesController Test Case
 *
 * @uses \App\Controller\Founder\LaserMachineRatesController
 */
class LaserMachineRatesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.LaserMachineRates',
        'app.LaserMachines',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\Founder\LaserMachineRatesController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\Founder\LaserMachineRatesController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\Founder\LaserMachineRatesController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\Founder\LaserMachineRatesController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\Founder\LaserMachineRatesController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
