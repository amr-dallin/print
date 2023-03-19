<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\PapersHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\PapersHelper Test Case
 */
class PapersHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\PapersHelper
     */
    protected $Papers;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->Papers = new PapersHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Papers);

        parent::tearDown();
    }
}
