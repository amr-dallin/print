<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OpCollection Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $date_from
 * @property \Cake\I18n\FrozenDate $date_to
 * @property \Cake\I18n\FrozenDate|null $date_collection
 * @property bool $confirmed
 * @property string|null $notes
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $date_modified
 *
 * @property \App\Model\Entity\OpService[] $op_services
 */
class OpCollection extends Entity
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
        'date_from' => true,
        'date_to' => true,
        'date_collection' => true,
        'confirmed' => true,
        'notes' => true,
        'date_created' => true,
        'date_modified' => true,
        'op_services' => true,
    ];
}
