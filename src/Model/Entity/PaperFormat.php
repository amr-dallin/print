<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PaperFormat Entity
 *
 * @property int $id
 * @property string $title
 * @property int $width
 * @property int $height
 * @property string|null $description
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $date_modified
 *
 * @property \App\Model\Entity\Paper[] $papers
 */
class PaperFormat extends Entity
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
        'width' => true,
        'height' => true,
        'description' => true,
        'date_created' => true,
        'date_modified' => true,
        'papers' => true,
    ];

    protected $_virtual = ['full_name'];

    protected function _getFullName()
    {
        return __('{0} ({1} x {2} mm)', $this->title, $this->width, $this->height);
    }
}
