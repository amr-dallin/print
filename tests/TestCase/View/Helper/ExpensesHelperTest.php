<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\ExpensesHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\ExpensesHelper Test Case
 */
class ExpensesHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\ExpensesHelper
     */
    protected $Expenses;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->Expenses = new ExpensesHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Expenses);

        parent::tearDown();
    }
}
