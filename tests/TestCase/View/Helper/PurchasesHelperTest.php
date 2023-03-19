<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\PurchasesHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\PurchasesHelper Test Case
 */
class PurchasesHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\PurchasesHelper
     */
    protected $Purchases;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->Purchases = new PurchasesHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Purchases);

        parent::tearDown();
    }
}
