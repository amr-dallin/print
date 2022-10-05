<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OpService Entity
 *
 * @property int $id
 * @property int|null $op_collection_id
 * @property string $type
 * @property string $method
 * @property string $amount
 * @property \Cake\I18n\FrozenDate $date_of_service
 * @property string|null $notes
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $date_modified
 */
class OpService extends Entity
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
        'op_collection_id' => true,
        'type' => true,
        'method' => true,
        'amount' => true,
        'date_of_service' => true,
        'notes' => true,
        'date_created' => true,
        'date_modified' => true,
    ];
}
