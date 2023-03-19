<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\PhoneNumbersHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\PhoneNumbersHelper Test Case
 */
class PhoneNumbersHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\PhoneNumbersHelper
     */
    protected $PhoneNumbers;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->PhoneNumbers = new PhoneNumbersHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->PhoneNumbers);

        parent::tearDown();
    }
}
