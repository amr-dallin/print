<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Utility\Inflector;

/**
 * Expense Entity
 *
 * @property int $id
 * @property string $foreign_key
 * @property string $model
 * @property float $quantity
 * @property string|null $description
 * @property \Cake\I18n\FrozenDate $date_expensed
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $date_modified
 * 
 * @property \App\Model\Entity\Consumable $consumable
 * @property \App\Model\Entity\Paper $paper
 */
class Expense extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'foreign_key' => true,
        'model' => true,
        'quantity' => true,
        'description' => true,
        'date_expensed' => true,
        'date_created' => true,
        'date_modified' => true,
        'consumable' => true,
        'paper' => true,
    ];

    protected $_virtual = ['title'];

    protected function _getTitle()
    {
        if ($this->isNew()) {
            return;
        }

        $model = mb_strtolower(Inflector::singularize($this->model));
        if (!isset($this->{$model})) {
            return __('Indefined');
        }

        return $this->{$model}->full_name;
    }
}
