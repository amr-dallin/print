<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Materials helper
 */
class MaterialsHelper extends Helper
{
    public $helpers = ['Html', 'Number'];

    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    public function listOfModels()
    {
        return [
            PURCHASE_ENTITY_MODEL_CONSUMABLE => __('Consumable'),
            PURCHASE_ENTITY_MODEL_PAPER => __('Paper')
        ];
    }

    public function modelIcon($material)
    {
        switch($material->model) {
            case PURCHASE_ENTITY_MODEL_PAPER:
                return $this->Html->tag('span', $this->listOfModels()[PURCHASE_ENTITY_MODEL_PAPER], ['class' => 'badge badge-success']);
                break;
            case PURCHASE_ENTITY_MODEL_CONSUMABLE:
                return $this->Html->tag('span', $this->listOfModels()[PURCHASE_ENTITY_MODEL_CONSUMABLE], ['class' => 'badge badge-warning']);
                break;
        }
    }
}
