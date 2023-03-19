<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\ConsumablesHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\ConsumablesHelper Test Case
 */
class ConsumablesHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\ConsumablesHelper
     */
    protected $Consumables;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->Consumables = new ConsumablesHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Consumables);

        parent::tearDown();
    }
}
