<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Representative Entity
 *
 * @property string $id
 * @property string $foreign_key
 * @property string $model
 * @property string $first_name
 * @property string|null $second_name
 * @property string|null $sur_name
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $date_modified
 */
class Representative extends Entity
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
        'first_name' => true,
        'second_name' => true,
        'sur_name' => true,
        'date_created' => true,
        'date_modified' => true,
        'phone_number' => true
    ];

    protected $_virtual = ['full_name'];

    protected function _getFullName()
    {
        $fullName = $this->first_name;
        if (!empty($this->sur_name)) {
            $fullName = $this->sur_name . ' ' . $fullName;
        }

        if (!empty($this->second_name)) {
            $fullName = $fullName . ' ' . $this->second_name;
        }

        return $fullName;
    }
}
