<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Actions helper
 */
class ActionsHelper extends Helper
{
    public $helpers = ['ActionPrices', 'Html', 'Number'];

    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    public function groupTypeIcon($groupType)
    {
        switch($groupType) {
            case ACTIONS_GROUP_TYPE_PREPRESS:
                return $this->Html->tag('span',
                    $this->groupTypeList()[ACTIONS_GROUP_TYPE_PREPRESS],
                    ['class' => 'badge badge-warning']
                );
                break;
            case ACTIONS_GROUP_TYPE_PRESS:
                return $this->Html->tag('span',
                    $this->groupTypeList()[ACTIONS_GROUP_TYPE_PRESS],
                    ['class' => 'badge badge-success']
                );
                break;
            case ACTIONS_GROUP_TYPE_POSTPRESS:
                return $this->Html->tag('span',
                    $this->groupTypeList()[ACTIONS_GROUP_TYPE_POSTPRESS],
                    ['class' => 'badge badge-primary']
                );
                break;
        }
    }

    public function groupTypeList()
    {
        return [
            ACTIONS_GROUP_TYPE_PREPRESS => __('Preprint'),
            ACTIONS_GROUP_TYPE_PRESS => __('Print'),
            ACTIONS_GROUP_TYPE_POSTPRESS => __('Postprint')
        ];
    }

    public function currentPrice($actionPrices)
    {
        if (empty($actionPrices)) {
            return;
        }
        foreach($actionPrices as $actionPrice) {
            if ($this->ActionPrices->isCurrent($actionPrice)) {
                return $actionPrice->amount;
            }
        }
    }

    public function currentPriceDateCommited($actionPrices)
    {
        if (empty($actionPrices)) {
            return;
        }
        foreach($actionPrices as $actionPrice) {
            if ($this->ActionPrices->isCurrent($actionPrice)) {
                return $actionPrice->date_commited;
            }
        }
    }

    public function currentPriceView($actionPrices)
    {
        $currentPrice = $this->currentPrice($actionPrices);
        $currentPriceDateCommited = $this->currentPriceDateCommited($actionPrices);
        if (!empty($currentPrice)) {
            return $this->Number->currency($currentPrice, 'UZS') . ' (' . $currentPriceDateCommited->format('d.m.Y') . ')';
        }
        return __('Not determined');
    }
}
