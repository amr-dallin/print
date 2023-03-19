<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\ProductProcessesHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\ProductProcessesHelper Test Case
 */
class ProductProcessesHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\ProductProcessesHelper
     */
    protected $ProductProcesses;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->ProductProcesses = new ProductProcessesHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ProductProcesses);

        parent::tearDown();
    }
}
