<?php
declare(strict_types=1);

namespace App\View\Cell\Founder;

use Cake\View\Cell;

/**
 * CashRegister cell
 */
class CashRegisterCell extends Cell
{
    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array<string, mixed>
     */
    protected $_validCellOptions = [];

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

    public function totalExpenses()
    {
        $opExpenses = $this->fetchTable('OpExpenses')->find();
        $this->set('opExpenses', $opExpenses);
    }

    public function totalReceipts()
    {
        $opReceipts = $this->fetchTable('OpReceipts')->find();
        $this->set('opReceipts', $opReceipts);
    }
    
    public function balance()
    {
        $opExpenses = $this->fetchTable('OpExpenses')->find();
        $opReceipts = $this->fetchTable('OpReceipts')->find();
        $this->set(compact('opExpenses', 'opReceipts'));
    }
}
