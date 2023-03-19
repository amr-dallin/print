<?php
declare(strict_types=1);

namespace App\View\Cell\Founder;

use Cake\View\Cell;

/**
 * Expenses cell
 */
class ExpensesCell extends Cell
{
    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array<string, mixed>
     */
    protected $_validCellOptions = ['limit'];

    protected $limit = 10;

    /**
     * Initialization logic run at the end of object construction.
     *
     * @return void
     */
    public function initialize(): void
    {
    }

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
    }

    public function last()
    {
        $expenses = $this->fetchTable('Expenses')->find()
            ->contain([
                'Consumables' => [
                    'InitialUnits',
                    'ConsumableCategories',
                    'Units'
                ],
                'Papers' => [
                    'InitialUnits',
                    'PaperColors',
                    'PaperDensities',
                    'PaperFormats',
                    'PaperTypes',
                    'Units'
                ]
            ])
            ->order(['Expenses.date_expensed' => 'DESC'])
            ->limit($this->limit);

        $this->set('expenses', $expenses->toArray());
    }
}
