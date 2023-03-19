<?php
declare(strict_types=1);

namespace App\View\Cell\Founder;

use Cake\View\Cell;

/**
 * OpReceipts cell
 */
class OpReceiptsCell extends Cell
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
        $opReceipts = $this->fetchTable('OpReceipts')->find()
            ->order(['OpReceipts.date_receipted' => 'DESC'])
            ->limit($this->limit);

        $this->set('opReceipts', $opReceipts);
    }
}
