<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Consumable Entity
 *
 * @property int $id
 * @property int $consumable_category_id
 * @property int $initial_unit_id
 * @property int $unit_id
 * @property float $quantity
 * @property string $type
 * @property string $title
 * @property string|null $description
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $date_modified
 *
 * @property \App\Model\Entity\Unit $initial_unit
 * @property \App\Model\Entity\ConsumableCategory $consumable_category
 * @property \App\Model\Entity\Unit $unit
 */
class Consumable extends Entity
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
        'consumable_category_id' => true,
        'initial_unit_id' => true,
        'unit_id' => true,
        'quantity' => true,
        'type' => true,
        'title' => true,
        'description' => true,
        'date_created' => true,
        'date_modified' => true,
        'consumable_category' => true,
        'unit' => true,
        'expenses' => true,
        'purchase_entities' => true,
        'consumable_prices' => true
    ];

    protected $_virtual = ['full_name'];

    protected function _getFullName()
    {
        return $this->title;
    }
}
