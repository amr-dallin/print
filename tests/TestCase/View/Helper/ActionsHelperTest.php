<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\ActionsHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\ActionsHelper Test Case
 */
class ActionsHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\ActionsHelper
     */
    protected $Actions;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->Actions = new ActionsHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Actions);

        parent::tearDown();
    }
}
