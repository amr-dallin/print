<?php
declare(strict_types=1);

namespace App\View\Cell\Founder;

use Cake\View\Cell;

/**
 * PurchaseEntities cell
 */
class PurchaseEntitiesCell extends Cell
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
        $purchaseEntities = $this->fetchTable('PurchaseEntities')->find()
            ->innerJoinWith('Purchases', function ($q) {
                return $q->find('approved');
            })
            ->contain([
                'Consumables' => [
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
                ],
                'Purchases'
            ])
            ->order(['Purchases.date_purchased' => 'DESC'])
            ->limit($this->limit);

        $this->set('purchaseEntities', $purchaseEntities->toArray());
    }
}
