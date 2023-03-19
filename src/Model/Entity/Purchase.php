<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Purchase Entity
 *
 * @property int $id
 * @property int $supplier_id
 * @property \Cake\I18n\FrozenDate|null $date_purchased
 * @property string|null $description
 * @property string $status
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $date_modified
 *
 * @property \App\Model\Entity\Supplier $supplier
 * @property \App\Model\Entity\PurchaseEntity[] $purchase_entities
 */
class Purchase extends Entity
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
        'supplier_id' => true,
        'date_purchased' => true,
        'description' => true,
        'status' => true,
        'date_created' => true,
        'date_modified' => true,
        'supplier' => true,
        'purchase_entities' => true,
    ];
}
