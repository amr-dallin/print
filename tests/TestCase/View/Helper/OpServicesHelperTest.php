<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\OpServicesHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\OpServicesHelper Test Case
 */
class OpServicesHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\OpServicesHelper
     */
    protected $OpServices;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->OpServices = new OpServicesHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->OpServices);

        parent::tearDown();
    }
}
