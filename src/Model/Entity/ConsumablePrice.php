<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ConsumablePrice Entity
 *
 * @property int $id
 * @property int $consumable_id
 * @property string $amount
 * @property bool $is_current
 * @property \Cake\I18n\FrozenDate $date_commited
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $date_modified
 *
 * @property \App\Model\Entity\Consumable $consumable
 * @property \App\Model\Entity\ProcessConsumable[] $process_consumables
 */
class ConsumablePrice extends Entity
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
        'consumable_id' => true,
        'amount' => true,
        'is_current' => true,
        'date_commited' => true,
        'date_created' => true,
        'date_modified' => true,
        'consumable' => true,
        'process_consumables' => true,
    ];
}
