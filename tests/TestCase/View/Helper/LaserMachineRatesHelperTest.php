<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\LaserMachineRatesHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\LaserMachineRatesHelper Test Case
 */
class LaserMachineRatesHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\LaserMachineRatesHelper
     */
    protected $LaserMachineRates;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->LaserMachineRates = new LaserMachineRatesHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->LaserMachineRates);

        parent::tearDown();
    }
}
