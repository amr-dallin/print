<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PhoneNumber Entity
 *
 * @property string $id
 * @property string $foreign_key
 * @property string $model
 * @property string $number
 * @property bool $is_telegram
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $date_modified
 */
class PhoneNumber extends Entity
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
        'foreign_key' => true,
        'model' => true,
        'number' => true,
        'is_telegram' => true,
        'date_created' => true,
        'date_modified' => true,
    ];

    protected $_virtual = ['full_number'];

    protected function _getFullNumber()
    {
        return '+998' . $this->number;
    }
}
