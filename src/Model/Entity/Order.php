<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property int|null $client_id
 * @property string $unique_id
 * @property string|null $client_full_name
 * @property string|null $client_telephone
 * @property string|null $title
 * @property string|null $description
 * @property string|null $cost_price
 * @property string|null $saved_price
 * @property string|null $profit_cost
 * @property \Cake\I18n\FrozenTime|null $date_deadline
 * @property \Cake\I18n\FrozenTime|null $date_accepted
 * @property string $status
 * @property string|null $status_message
 * @property \Cake\I18n\FrozenTime|null $date_completed
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $date_modified
 *
 * @property \App\Model\Entity\Client $client
 * @property \App\Model\Entity\Contractor $contractor
 * @property \App\Model\Entity\OrderProduct[] $order_products
 */
class Order extends Entity
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
        'client_id' => true,
        'unique_id' => true,
        'client_full_name' => true,
        'client_telephone' => true,
        'title' => true,
        'description' => true,
        'cost_price' => true,
        'saved_price' => true,
        'profit_cost' => true,
        'date_deadline' => true,
        'date_accepted' => true,
        'status' => true,
        'status_message' => true,
        'date_completed' => true,
        'date_created' => true,
        'date_modified' => true,
        'client' => true,
        'contractor' => true,
        'order_products' => true,
    ];
}
