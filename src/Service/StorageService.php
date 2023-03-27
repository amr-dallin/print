<?php
declare(strict_types=1);

namespace App\Service;

use Cake\Database\Expression\QueryExpression;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\FrozenTime;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\Utility\Inflector;

class StorageService
{
    use LocatorAwareTrait;

    public function getAbsentPapers()
    {
        return $this->queryPapers(
            $this->getEntitiesId('Papers', '<=')
        );
    }

    public function getAvailablePapers()
    {
        return $this->queryPapers(
            $this->getEntitiesId('Papers', '>')
        );
    }

    public function getAbsentConsumables()
    {
        return $this->queryConsumables(
            $this->getEntitiesId('Consumables', '<=')
        );
    }

    public function getAvailableConsumables()
    {
        return $this->queryConsumables(
            $this->getEntitiesId('Consumables', '>')
        );
    }

    private function queryConsumables($ids)
    {
        return $this->getTableLocator()->get('Consumables')->find()
            ->where(['Consumables.id IN' => $ids])
            ->contain([
                'ConsumableCategories',
                'Expenses',
                'InitialUnits',
                'PurchaseEntities',
                'Units'
            ]);
    }

    private function queryPapers($ids)
    {
        return $this->getTableLocator()->get('Papers')->find()
            ->where(['Papers.id IN' => $ids])
            ->contain([
                'Expenses',
                'InitialUnits',
                'PaperColors',
                'PaperDensities',
                'PaperFormats',
                'PaperTypes',
                'PurchaseEntities',
                'Units'
            ]);
    }

    private function getEntitiesId($model, $exp)
    {
        $connection = ConnectionManager::get('default');
        $ids = $connection->execute(
            'select `p`.`id` from ' . Inflector::dasherize($model) . ' `p`
            where
                IFNULL
                    (
                        (
                            select sum(`pe`.`quantity`)
                            from `purchase_entities` `pe`
                            where `pe`.`model` = :model and `pe`.`foreign_key` = `p`.`id`
                        ), 0

                    ) -
                IFNULL
                    (
                        (
                            select sum(`e`.`quantity`)
                            from `expenses` `e`
                            where `e`.`model` = :model and `e`.`foreign_key` = `p`.`id`
                        ), 0
                    ) ' . $exp . ' 0;', ['model' => $model]
        )->fetchAll('assoc');

        $result = [];
        foreach($ids as $id) {
            $result[] = $id['id'];
        }

        return $result;
    }
}