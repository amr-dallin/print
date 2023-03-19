<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\ProcessConsumablesHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\ProcessConsumablesHelper Test Case
 */
class ProcessConsumablesHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\ProcessConsumablesHelper
     */
    protected $ProcessConsumables;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->ProcessConsumables = new ProcessConsumablesHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ProcessConsumables);

        parent::tearDown();
    }
}
