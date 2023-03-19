<?php
declare(strict_types=1);

namespace App\Service;

use Cake\I18n\FrozenTime;
use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Locator\LocatorAwareTrait;

class ExpensesService
{
    use LocatorAwareTrait;

    public function getRange($range = null)
    {
        $expenses = $this->getTableLocator()->get('Expenses')->find()
            ->contain([
                'Consumables' => [
                    'InitialUnits',
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
                ]
            ]);

        if (null !== $range) {
            list($date_from, $date_to) = explode(' - ', $range);
            $expenses->where(function (QueryExpression $exp) use ($date_from, $date_to) {
                return $exp->between('date_expensed', new FrozenTime($date_from), new FrozenTime($date_to));
            });
        }

        return $expenses->toArray();
    }
}