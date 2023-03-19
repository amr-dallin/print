<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\PaperDensitiesHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\PaperDensitiesHelper Test Case
 */
class PaperDensitiesHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\PaperDensitiesHelper
     */
    protected $PaperDensities;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->PaperDensities = new PaperDensitiesHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->PaperDensities);

        parent::tearDown();
    }
}
