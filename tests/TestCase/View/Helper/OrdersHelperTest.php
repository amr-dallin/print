<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\OrdersHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\OrdersHelper Test Case
 */
class OrdersHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\OrdersHelper
     */
    protected $Orders;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->Orders = new OrdersHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Orders);

        parent::tearDown();
    }
}
