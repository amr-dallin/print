<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\ProcessPapersHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\ProcessPapersHelper Test Case
 */
class ProcessPapersHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\ProcessPapersHelper
     */
    protected $ProcessPapers;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->ProcessPapers = new ProcessPapersHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ProcessPapers);

        parent::tearDown();
    }
}
