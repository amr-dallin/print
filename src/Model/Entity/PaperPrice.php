<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PaperPrice Entity
 *
 * @property int $id
 * @property int $paper_id
 * @property string $amount
 * @property bool $is_current
 * @property \Cake\I18n\FrozenDate $date_commited
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $date_modified
 *
 * @property \App\Model\Entity\Paper $paper
 * @property \App\Model\Entity\ProcessPaper[] $process_papers
 */
class PaperPrice extends Entity
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
        'paper_id' => true,
        'amount' => true,
        'is_current' => true,
        'date_commited' => true,
        'date_created' => true,
        'date_modified' => true,
        'paper' => true,
        'process_papers' => true,
    ];
}
