<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProductProcess Entity
 *
 * @property int $id
 * @property int|null $contractor_id
 * @property int $order_product_id
 * @property string $type
 * @property string $group_type
 * @property string $unique_id
 * @property string|null $contractor_full_name
 * @property string|null $contractor_telephone
 * @property string $title
 * @property string|null $description
 * @property string|null $cost_price
 * @property string $status
 * @property string|null $status_message
 * @property \Cake\I18n\FrozenTime|null $date_completed
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $date_modified
 *
 * @property \App\Model\Entity\Contractor $contractor
 * @property \App\Model\Entity\OrderProduct $order_product
 * @property \App\Model\Entity\ProcessAction[] $process_actions
 * @property \App\Model\Entity\ProcessConsumable[] $process_consumables
 * @property \App\Model\Entity\ProcessLaserMachine[] $process_laser_machines
 * @property \App\Model\Entity\ProcessPaper[] $process_papers
 */
class ProductProcess extends Entity
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
        'order_product_id' => true,
        'type' => true,
        'group_type' => true,
        'unique_id' => true,
        'contractor_full_name' => true,
        'contractor_telephone' => true,
        'title' => true,
        'description' => true,
        'cost_price' => true,
        'status' => true,
        'status_message' => true,
        'date_completed' => true,
        'date_created' => true,
        'date_modified' => true,
        'contractor' => true,
        'order_product' => true,
        'process_action' => true,
        'process_connections' => true,
        'process_consumables' => true,
        'process_laser_machine' => true,
        'process_papers' => true,
    ];

    protected $_virtual = ['full_name'];

    protected function _getFullName()
    {
        return (!empty($this->title)) ? "#{$this->unique_id} – {$this->title}" : "#{$this->unique_id}";
    }
}
