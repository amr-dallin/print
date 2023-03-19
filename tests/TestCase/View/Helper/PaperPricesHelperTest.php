<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\PaperPricesHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\PaperPricesHelper Test Case
 */
class PaperPricesHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\PaperPricesHelper
     */
    protected $PaperPrices;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->PaperPrices = new PaperPricesHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->PaperPrices);

        parent::tearDown();
    }
}
