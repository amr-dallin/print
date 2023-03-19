<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Action Entity
 *
 * @property int $id
 * @property int $unit_id
 * @property string $group_type
 * @property string $title
 * @property string|null $description
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $date_modified
 *
 * @property \App\Model\Entity\Unit $unit
 * @property \App\Model\Entity\ActionPrice[] $action_prices
 */
class Action extends Entity
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
        'unit_id' => true,
        'group_type' => true,
        'title' => true,
        'description' => true,
        'date_created' => true,
        'date_modified' => true,
        'unit' => true,
        'action_prices' => true,
    ];

    protected $_virtual = ['title_with_unit'];

    protected function _getTitleWithUnit()
    {
        if (null !== $this->unit) {
            return "{$this->title} ({$this->unit->title})";
        }
    }
}
