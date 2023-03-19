<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Client Entity
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $type
 * @property string|null $title
 * @property string|null $description
 * @property float|null $discount
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $date_modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Order[] $orders
 */
class Client extends Entity
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
        'user_id' => true,
        'type' => true,
        'title' => true,
        'description' => true,
        'discount' => true,
        'date_created' => true,
        'date_modified' => true,
        'user' => true,
        'orders' => true,
        'representative' => true
    ];
}
