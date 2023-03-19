<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PaperFormatsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PaperFormatsTable Test Case
 */
class PaperFormatsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PaperFormatsTable
     */
    protected $PaperFormats;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.PaperFormats',
        'app.Papers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('PaperFormats') ? [] : ['className' => PaperFormatsTable::class];
        $this->PaperFormats = $this->getTableLocator()->get('PaperFormats', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->PaperFormats);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PaperFormatsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
