<?php
declare(strict_types=1);

namespace App\Service;

use App\Service\OrdersService;
use Cake\ORM\Locator\LocatorAwareTrait;

class ProcessPapersService
{
    use LocatorAwareTrait;

    public function save($processPaper)
    {
        $paperPrice = $this->getTableLocator()->get('PaperPrices')->get($processPaper->paper_price_id);
        $processPaper->set('cost_price', $this->getCostPrice($processPaper, $paperPrice));
        if ($this->getTableLocator()->get('ProcessPapers')->save($processPaper)) {
            $order = $this->getTableLocator()->get('Orders')->find()
                ->innerJoinWith('OrderProducts.ProductProcesses.ProcessPapers', function ($q) use ($processPaper) {
                    return $q->where([
                        'ProcessPapers.id' => $processPaper->id
                    ]);
                })
                ->firstOrFail();

            (new OrdersService())->cost($order->id);

            return true;
        }

        return false;
    }

    private function getCostPrice($processPaper, $paperPrice): string
    {
        return bcmul(
            (string)$processPaper->quantity,
            (string)$paperPrice->amount,
            4
        );
    }
}