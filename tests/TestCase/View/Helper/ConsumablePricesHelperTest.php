<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\ConsumablePricesHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\ConsumablePricesHelper Test Case
 */
class ConsumablePricesHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\ConsumablePricesHelper
     */
    protected $ConsumablePrices;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->ConsumablePrices = new ConsumablePricesHelper($view);
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
}
