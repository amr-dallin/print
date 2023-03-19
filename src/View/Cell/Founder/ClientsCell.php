<?php
declare(strict_types=1);

namespace App\View\Cell\Founder;

use Cake\View\Cell;

/**
 * Clients cell
 */
class ClientsCell extends Cell
{
    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array<string, mixed>
     */
    protected $_validCellOptions = ['limit'];

    protected $limit = 5;

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

    public function topExternal()
    {
        $query = $this->fetchTable('Clients')->find('external')
            ->matching('Orders', function ($q) {
                return $q->find('completed')->find('withProfitCost');
            })
            ->order(['total_profit_cost' => 'DESC'])
            ->group(['Clients.id'])
            ->limit($this->limit);

        $clients = $query->select([
            'id' => 'Clients.id',
            'title' => 'Clients.title',
            'quantity' => $query->func()->count('Orders.id'),
            'total_profit_cost' => $query->func()->sum('Orders.profit_cost')
        ]);

        $this->set('clients', $clients->toArray());
    }

    public function topInternal()
    {
        $query = $this->fetchTable('Clients')->find('internal')
            ->matching('Orders', function ($q) {
                return $q->find('completed')->find('withCostPrice');
            })
            ->order(['total_cost_price' => 'DESC'])
            ->group(['Clients.id'])
            ->limit($this->limit);

        $clients = $query->select([
            'id' => 'Clients.id',
            'title' => 'Clients.title',
            'quantity' => $query->func()->count('Orders.id'),
            'total_cost_price' => $query->func()->sum('Orders.cost_price')
        ]);

        $this->set('clients', $clients->toArray());
    }
}
