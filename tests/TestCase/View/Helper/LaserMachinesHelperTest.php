<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\LaserMachinesHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\LaserMachinesHelper Test Case
 */
class LaserMachinesHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\LaserMachinesHelper
     */
    protected $LaserMachines;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->LaserMachines = new LaserMachinesHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->LaserMachines);

        parent::tearDown();
    }
}
