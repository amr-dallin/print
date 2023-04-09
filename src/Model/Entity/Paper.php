<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Paper Entity
 *
 * @property int $id
 * @property int $paper_color_id
 * @property int $paper_density_id
 * @property int $paper_format_id
 * @property int $paper_type_id
 * @property int $initial_unit_id
 * @property int $unit_id
 * @property float $quantity
 * @property string $title
 * @property float|null $thickness
 * @property string|null $description
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $date_modified
 *
 * @property \App\Model\Entity\Unit $initial_unit
 * @property \App\Model\Entity\PaperColor $paper_color
 * @property \App\Model\Entity\PaperDensity $paper_density
 * @property \App\Model\Entity\PaperFormat $paper_format
 * @property \App\Model\Entity\PaperType $paper_type
 * @property \App\Model\Entity\Unit $unit
 */
class Paper extends Entity
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
        'paper_color_id' => true,
        'paper_density_id' => true,
        'paper_format_id' => true,
        'paper_type_id' => true,
        'initial_unit_id' => true,
        'unit_id' => true,
        'quantity' => true,
        'title' => true,
        'thickness' => true,
        'description' => true,
        'date_created' => true,
        'date_modified' => true,
        'initial_paper' => true,
        'paper_color' => true,
        'paper_density' => true,
        'paper_format' => true,
        'paper_type' => true,
        'unit' => true,
        'expenses' => true,
        'purchase_entities' => true,
        'paper_prices' => true
    ];

    protected $_virtual = ['full_name'];

    protected function _getFullName()
    {
        $paperFormat = '';
        if (null !== $this->paper_format) {
            $paperFormat = ", {$this->paper_format->title}";
        }

        $paperDensity = '';
        if (null !== $this->paper_density) {
            $paperDensity = ", {$this->paper_density->density}";
        }

        return $this->title . $paperFormat . $paperDensity;
    }
}
