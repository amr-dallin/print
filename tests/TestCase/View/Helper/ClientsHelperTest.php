<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\ClientsHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\ClientsHelper Test Case
 */
class ClientsHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\ClientsHelper
     */
    protected $Clients;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->Clients = new ClientsHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Clients);

        parent::tearDown();
    }
}
