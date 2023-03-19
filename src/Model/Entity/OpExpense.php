<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OpExpense Entity
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string $amount
 * @property \Cake\I18n\FrozenDate $date_expensed
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $date_modified
 */
class OpExpense extends Entity
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
        'title' => true,
        'description' => true,
        'amount' => true,
        'date_expensed' => true,
        'date_created' => true,
        'date_modified' => true,
    ];
}
