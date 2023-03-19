<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LaserMachine Entity
 *
 * @property int $id
 * @property string $type
 * @property string $title
 * @property string|null $description
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $date_modified
 * @property bool $is_active
 *
 * @property \App\Model\Entity\LaserMachineRate[] $laser_machine_rates
 */
class LaserMachine extends Entity
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
        'type' => true,
        'title' => true,
        'description' => true,
        'date_created' => true,
        'date_modified' => true,
        'is_active' => true,
        'laser_machine_rates' => true,
    ];
}
