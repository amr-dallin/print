<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\PurchaseEntitiesHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\PurchaseEntitiesHelper Test Case
 */
class PurchaseEntitiesHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\PurchaseEntitiesHelper
     */
    protected $PurchaseEntities;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->PurchaseEntities = new PurchaseEntitiesHelper($view);
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
}
