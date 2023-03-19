<?php
declare(strict_types=1);

namespace App\Service;

use Cake\I18n\FrozenTime;
use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Locator\LocatorAwareTrait;

class PaperPricesService
{
    use LocatorAwareTrait;

    public function save($paperPrice)
    {
        $oldPaperPrices = $this->getTableLocator()->get('PaperPrices')->find()
            ->where(['PaperPrices.paper_id' => $paperPrice->paper_id]);

        foreach($oldPaperPrices as $oldPaperPrice) {
            $oldPaperPrice->set('is_current', false);
            $this->getTableLocator()->get('PaperPrices')->save($oldPaperPrice);
        }

        $paperPrice->set('is_current', true);
        return $this->getTableLocator()->get('PaperPrices')->save($paperPrice);
    }
}