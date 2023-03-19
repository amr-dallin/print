<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\ActionPricesHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\ActionPricesHelper Test Case
 */
class ActionPricesHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\ActionPricesHelper
     */
    protected $ActionPrices;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->ActionPrices = new ActionPricesHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ActionPrices);

        parent::tearDown();
    }
}
