<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProcessConnection Entity
 *
 * @property int $id
 * @property int $parent_id
 * @property int $process_id
 *
 * @property \App\Model\Entity\ParentProcessConnection $parent_process_connection
 * @property \App\Model\Entity\ProductProcess $product_process
 * @property \App\Model\Entity\ChildProcessConnection[] $child_process_connections
 */
class ProcessConnection extends Entity
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
        'parent_id' => true,
        'process_id' => true,
        'parent_process' => true,
        'product_process' => true,
    ];
}
