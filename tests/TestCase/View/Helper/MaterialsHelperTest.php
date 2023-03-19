<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\MaterialsHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\MaterialsHelper Test Case
 */
class MaterialsHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\MaterialsHelper
     */
    protected $Materials;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->Materials = new MaterialsHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Materials);

        parent::tearDown();
    }
}
