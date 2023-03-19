<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProcessConsumable Entity
 *
 * @property int $id
 * @property int $consumable_price_id
 * @property int $product_process_id
 * @property float $quantity
 * @property string|null $cost_price
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $date_modified
 *
 * @property \App\Model\Entity\ConsumablePrice $consumable_price
 * @property \App\Model\Entity\ProductProcess $product_process
 */
class ProcessConsumable extends Entity
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
        'consumable_price_id' => true,
        'product_process_id' => true,
        'quantity' => true,
        'cost_price' => true,
        'date_created' => true,
        'date_modified' => true,
        'consumable_price' => true,
        'product_process' => true,
    ];
}
