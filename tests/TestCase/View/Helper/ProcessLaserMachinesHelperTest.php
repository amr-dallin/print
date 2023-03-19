<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\ProcessLaserMachinesHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\ProcessLaserMachinesHelper Test Case
 */
class ProcessLaserMachinesHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\ProcessLaserMachinesHelper
     */
    protected $ProcessLaserMachines;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->ProcessLaserMachines = new ProcessLaserMachinesHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ProcessLaserMachines);

        parent::tearDown();
    }
}
