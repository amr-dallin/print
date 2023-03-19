<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\OrderProductsHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\OrderProductsHelper Test Case
 */
class OrderProductsHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\OrderProductsHelper
     */
    protected $OrderProducts;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->OrderProducts = new OrderProductsHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->OrderProducts);

        parent::tearDown();
    }
}
