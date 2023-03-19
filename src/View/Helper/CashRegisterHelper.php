<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * CashRegister helper
 */
class CashRegisterHelper extends Helper
{
    public $helpers = ['Html', 'Number'];

    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    public function totalExpenses($opExpenses): string
    {
        $totalExpenses = (string)0;
        foreach($opExpenses as $opExpense)
        {
            $totalExpenses = bcadd(
                $totalExpenses,
                (string)$opExpense->amount,
                4
            );
        }

        return $totalExpenses;
    }

    public function totalReceipts($opReceipts): string
    {
        $totalReceipts = (string)0;
        foreach($opReceipts as $opReceipt)
        {
            $totalReceipts = bcadd(
                $totalReceipts,
                (string)$opReceipt->amount,
                4
            );
        }

        return $totalReceipts;
    }

    public function balance($opExpenses, $opReceipts): string
    {
        $totalExpenses = $this->totalExpenses($opExpenses);
        $totalReceipts = $this->totalReceipts($opReceipts);

        return bcsub($totalReceipts, $totalExpenses, 4);
    }
}
