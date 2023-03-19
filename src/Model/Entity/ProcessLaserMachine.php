<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProcessLaserMachine Entity
 *
 * @property int $id
 * @property int $laser_machine_rate_id
 * @property int $product_process_id
 * @property int $number_of_copies
 * @property int $number_of_pages
 * @property int $width
 * @property int $height
 * @property string $print_type
 * @property float $pouring
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $date_modified
 *
 * @property \App\Model\Entity\LaserMachineRate $laser_machine_rate
 * @property \App\Model\Entity\ProductProcess $product_process
 */
class ProcessLaserMachine extends Entity
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
        'laser_machine_rate_id' => true,
        'product_process_id' => true,
        'number_of_copies' => true,
        'number_of_pages' => true,
        'width' => true,
        'height' => true,
        'print_type' => true,
        'pouring' => true,
        'date_created' => true,
        'date_modified' => true,
        'laser_machine_rate' => true,
        'product_process' => true,
    ];

    protected $_virtual = ['pouring_title', 'size'];

    protected function _getSize()
    {
        return __('{0} x {1} mm', $this->width, $this->height);
    }

    protected function _getPouringTitle()
    {
        return $this->pouring . '%';
    }
}
