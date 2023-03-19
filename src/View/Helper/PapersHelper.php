<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Papers helper
 */
class PapersHelper extends Helper
{
    public $helpers = ['Html', 'Number', 'PaperPrices'];

    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    public function currentPrice($paperPrices)
    {
        if (empty($paperPrices)) {
            return;
        }
        foreach($paperPrices as $paperPrice) {
            if ($this->PaperPrices->isCurrent($paperPrice)) {
                return $paperPrice->amount;
            }
        }
    }

    public function currentPriceDateCommited($paperPrices)
    {
        if (empty($paperPrices)) {
            return;
        }
        foreach($paperPrices as $paperPrice) {
            if ($this->PaperPrices->isCurrent($paperPrice)) {
                return $paperPrice->date_commited;
            }
        }
    }

    public function currentPriceView($paperPrices)
    {
        $currentPrice = $this->currentPrice($paperPrices);
        $currentPriceDateCommited = $this->currentPriceDateCommited($paperPrices);
        if (!empty($currentPrice)) {
            return $this->Number->currency($currentPrice, 'UZS') . ' (' . $currentPriceDateCommited->format('d.m.Y') . ')';
        }
        return __('Not determined');
    }

    public function unitPrice($paper, $purchaseEntity)
    {
        return bcdiv((string)$purchaseEntity->amount, (string)$paper->quantity, 4);
    }
}
