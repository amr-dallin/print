<?php
declare(strict_types=1);

namespace App\View\Cell\Founder;

use Cake\View\Cell;

/**
 * Orders cell
 */
class OrdersCell extends Cell
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

    public function totalCompleted($clientId = null)
    {
        $orders = $this->fetchTable('Orders')
            ->find('completed');

        if (null !== $clientId) {
            $client = $this->fetchTable('Clients')
                ->findById($clientId)
                ->first();

            if (!empty($client)) {
                $orders->innerJoinWith('Clients', function ($q) use ($client) {
                    return $q->where(['Clients.id' => $client->id]);
                });
            }
        }

        $this->set('totalCompleted', $orders->count());
    }

    public function totalCostPrice($clientId = null)
    {
        $orders = $this->fetchTable('Orders')
            ->find('completed')
            ->find('withCostPrice');

        if (null !== $clientId) {
            $client = $this->fetchTable('Clients')
                ->findById($clientId)
                ->first();

            if (!empty($client)) {
                $orders->innerJoinWith('Clients', function ($q) use ($client) {
                    return $q->where(['Clients.id' => $client->id]);
                });
            }
        }

        $this->set('orders', $orders);
    }

    public function totalSavedPrice($clientId = null)
    {
        $orders = $this->fetchTable('Orders')
            ->find('completed')
            ->find('withSavedPrice');

        if (null !== $clientId) {
            $client = $this->fetchTable('Clients')
                ->findById($clientId)
                ->find('internal')
                ->first();

            if (!empty($client)) {
                $orders->innerJoinWith('Clients', function ($q) use ($client) {
                    return $q->where(['Clients.id' => $client->id]);
                });
            }
        }

        $this->set('orders', $orders);
    }

    public function totalProfitCost($clientId = null)
    {
        $orders = $this->fetchTable('Orders')
            ->find('completed')
            ->find('withProfitCost');

        if (null !== $clientId) {
            $client = $this->fetchTable('Clients')
                ->findById($clientId)
                ->find('external')
                ->first();

            if (!empty($client)) {
                $orders->innerJoinWith('Clients', function ($q) use ($client) {
                    return $q->where(['Clients.id' => $client->id]);
                });
            }
        }

        $this->set('orders', $orders);
    }

    public function totalIncome()
    {
        $orders = $this->fetchTable('Orders')
            ->find('completed')
            ->find('withSavedPriceOrProfitCost');

        $this->set('orders', $orders);
    }
}
