<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderProduct Entity
 *
 * @property int $id
 * @property int|null $contractor_id
 * @property int $order_id
 * @property int $product_type_id
 * @property string $type
 * @property string $unique_id
 * @property string|null $contractor_full_name
 * @property string|null $contractor_telephone
 * @property string|null $title
 * @property float $quantity
 * @property string|null $description
 * @property string|null $cost_price
 * @property string|null $competitive_price
 * @property string|null $profit_price
 * @property string $status
 * @property string|null $status_message
 * @property \Cake\I18n\FrozenTime|null $date_completed
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $date_modified
 *
 * @property \App\Model\Entity\Contractor $contractor
 * @property \App\Model\Entity\Order $order
 * @property \App\Model\Entity\ProductType $product_type
 * @property \App\Model\Entity\ProductProcess[] $product_processes
 */
class OrderProduct extends Entity
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
        'contractor_id' => true,
        'order_id' => true,
        'product_type_id' => true,
        'type' => true,
        'unique_id' => true,
        'contractor_full_name' => true,
        'contractor_telephone' => true,
        'title' => true,
        'quantity' => true,
        'description' => true,
        'cost_price' => true,
        'competitive_price' => true,
        'profit_price' => true,
        'status' => true,
        'status_message' => true,
        'date_completed' => true,
        'date_created' => true,
        'date_modified' => true,
        'contractor' => true,
        'order' => true,
        'product_type' => true,
        'product_processes' => true,
    ];
}
