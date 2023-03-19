<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ActionPrice Entity
 *
 * @property int $id
 * @property int $action_id
 * @property string $amount
 * @property bool $is_current
 * @property \Cake\I18n\FrozenDate $date_commited
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $date_modified
 *
 * @property \App\Model\Entity\Action $action
 * @property \App\Model\Entity\ProcessAction[] $process_actions
 */
class ActionPrice extends Entity
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
        'action_id' => true,
        'amount' => true,
        'is_current' => true,
        'date_commited' => true,
        'date_created' => true,
        'date_modified' => true,
        'action' => true,
        'process_actions' => true,
    ];
}
