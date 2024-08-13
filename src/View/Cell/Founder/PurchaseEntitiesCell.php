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
        $purchaseEntitiesList = $this->fetchTable('PurchaseEntities')->find()
            ->innerJoinWith('Purchases', function ($q) {
                return $q->find('approved');
            })
            ->order(['Purchases.date_purchased' => 'DESC'])
            ->limit($this->limit);

        $purchaseEntities = [];
        foreach($purchaseEntitiesList as $purchaseEntityList) {
            $purchaseEntity = $this->fetchTable('PurchaseEntities')
                ->findById($purchaseEntityList->id)
                ->contain('Purchases');

            switch($purchaseEntityList->model) {
                case 'Consumables':
                    $purchaseEntity = $purchaseEntity->contain([
                        'Consumables' => [
                            'ConsumableCategories',
                            'Units'
                        ]
                    ]);
                    break;
                case 'Papers':
                    $purchaseEntity = $purchaseEntity->contain([
                        'Papers' => [
                            'InitialUnits',
                            'PaperColors',
                            'PaperDensities',
                            'PaperFormats',
                            'PaperTypes',
                            'Units'
                        ]
                    ]);
                    break;
            }

            $purchaseEntity = $purchaseEntity->first();
            if (!empty($purchaseEntity)) {
                $purchaseEntities[] = $purchaseEntity;
            }
        }

        $this->set('purchaseEntities', $purchaseEntities);
    }
}
