<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\CashRegisterHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\CashRegisterHelper Test Case
 */
class CashRegisterHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\CashRegisterHelper
     */
    protected $CashRegister;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->CashRegister = new CashRegisterHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->CashRegister);

        parent::tearDown();
    }
}
