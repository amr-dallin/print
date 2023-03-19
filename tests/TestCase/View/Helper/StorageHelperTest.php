<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\StorageHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\StorageHelper Test Case
 */
class StorageHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\StorageHelper
     */
    protected $Storage;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->Storage = new StorageHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Storage);

        parent::tearDown();
    }
}
