<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Founder;

use App\Controller\Founder\PurchaseEntitiesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Founder\PurchaseEntitiesController Test Case
 *
 * @uses \App\Controller\Founder\PurchaseEntitiesController
 */
class PurchaseEntitiesControllerTest extends TestCase
{
    use IntegrationTestTrait;

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
     * Test index method
     *
     * @return void
     * @uses \App\Controller\Founder\PurchaseEntitiesController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\Founder\PurchaseEntitiesController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\Founder\PurchaseEntitiesController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\Founder\PurchaseEntitiesController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\Founder\PurchaseEntitiesController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
