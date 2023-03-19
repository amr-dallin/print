<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LaserMachineRate Entity
 *
 * @property int $id
 * @property int $laser_machine_id
 * @property float $default_pouring
 * @property float $default_size
 * @property string|null $toner_c_p
 * @property string|null $toner_m_p
 * @property string|null $toner_y_p
 * @property string $toner_k_p
 * @property string|null $drum_c_p
 * @property string|null $drum_m_p
 * @property string|null $drum_y_p
 * @property string $drum_k_p
 * @property string|null $developer_c_p
 * @property string|null $developer_m_p
 * @property string|null $developer_y_p
 * @property string $developer_k_p
 * @property float|null $extra
 * @property bool $is_current
 * @property \Cake\I18n\FrozenDate $date_commited
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $date_modified
 *
 * @property \App\Model\Entity\LaserMachine $laser_machine
 */
class LaserMachineRate extends Entity
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
        'laser_machine_id' => true,
        'default_pouring' => true,
        'default_size' => true,
        'toner_c_p' => true,
        'toner_m_p' => true,
        'toner_y_p' => true,
        'toner_k_p' => true,
        'drum_c_p' => true,
        'drum_m_p' => true,
        'drum_y_p' => true,
        'drum_k_p' => true,
        'developer_c_p' => true,
        'developer_m_p' => true,
        'developer_y_p' => true,
        'developer_k_p' => true,
        'extra' => true,
        'is_current' => true,
        'date_commited' => true,
        'date_created' => true,
        'date_modified' => true,
        'laser_machine' => true,
    ];
}
