<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\ProcessActionsHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\ProcessActionsHelper Test Case
 */
class ProcessActionsHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\ProcessActionsHelper
     */
    protected $ProcessActions;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->ProcessActions = new ProcessActionsHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ProcessActions);

        parent::tearDown();
    }
}
