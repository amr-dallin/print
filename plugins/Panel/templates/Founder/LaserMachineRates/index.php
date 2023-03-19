<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\Cake\Datasource\EntityInterface> $laserMachineRates
 */
?>
<div class="laserMachineRates index content">
    <?= $this->Html->link(__('New Laser Machine Rate'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Laser Machine Rates') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('laser_machine_id') ?></th>
                    <th><?= $this->Paginator->sort('default_pouring') ?></th>
                    <th><?= $this->Paginator->sort('default_size') ?></th>
                    <th><?= $this->Paginator->sort('toner_c_p') ?></th>
                    <th><?= $this->Paginator->sort('toner_m_p') ?></th>
                    <th><?= $this->Paginator->sort('toner_y_p') ?></th>
                    <th><?= $this->Paginator->sort('toner_k_p') ?></th>
                    <th><?= $this->Paginator->sort('drum_c_p') ?></th>
                    <th><?= $this->Paginator->sort('drum_m_p') ?></th>
                    <th><?= $this->Paginator->sort('drum_y_p') ?></th>
                    <th><?= $this->Paginator->sort('drum_k_p') ?></th>
                    <th><?= $this->Paginator->sort('developer_c_p') ?></th>
                    <th><?= $this->Paginator->sort('developer_m_p') ?></th>
                    <th><?= $this->Paginator->sort('developer_y_p') ?></th>
                    <th><?= $this->Paginator->sort('developer_k_p') ?></th>
                    <th><?= $this->Paginator->sort('extra') ?></th>
                    <th><?= $this->Paginator->sort('is_current') ?></th>
                    <th><?= $this->Paginator->sort('date_commited') ?></th>
                    <th><?= $this->Paginator->sort('date_created') ?></th>
                    <th><?= $this->Paginator->sort('date_modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($laserMachineRates as $laserMachineRate): ?>
                <tr>
                    <td><?= $this->Number->format($laserMachineRate->id) ?></td>
                    <td><?= $this->Number->format($laserMachineRate->laser_machine_id) ?></td>
                    <td><?= $this->Number->format($laserMachineRate->default_pouring) ?></td>
                    <td><?= $this->Number->format($laserMachineRate->default_size) ?></td>
                    <td><?= $laserMachineRate->toner_c_p === null ? '' : $this->Number->format($laserMachineRate->toner_c_p) ?></td>
                    <td><?= $laserMachineRate->toner_m_p === null ? '' : $this->Number->format($laserMachineRate->toner_m_p) ?></td>
                    <td><?= $laserMachineRate->toner_y_p === null ? '' : $this->Number->format($laserMachineRate->toner_y_p) ?></td>
                    <td><?= $this->Number->format($laserMachineRate->toner_k_p) ?></td>
                    <td><?= $laserMachineRate->drum_c_p === null ? '' : $this->Number->format($laserMachineRate->drum_c_p) ?></td>
                    <td><?= $laserMachineRate->drum_m_p === null ? '' : $this->Number->format($laserMachineRate->drum_m_p) ?></td>
                    <td><?= $laserMachineRate->drum_y_p === null ? '' : $this->Number->format($laserMachineRate->drum_y_p) ?></td>
                    <td><?= $this->Number->format($laserMachineRate->drum_k_p) ?></td>
                    <td><?= $laserMachineRate->developer_c_p === null ? '' : $this->Number->format($laserMachineRate->developer_c_p) ?></td>
                    <td><?= $laserMachineRate->developer_m_p === null ? '' : $this->Number->format($laserMachineRate->developer_m_p) ?></td>
                    <td><?= $laserMachineRate->developer_y_p === null ? '' : $this->Number->format($laserMachineRate->developer_y_p) ?></td>
                    <td><?= $this->Number->format($laserMachineRate->developer_k_p) ?></td>
                    <td><?= $laserMachineRate->extra === null ? '' : $this->Number->format($laserMachineRate->extra) ?></td>
                    <td><?= h($laserMachineRate->is_current) ?></td>
                    <td><?= h($laserMachineRate->date_commited) ?></td>
                    <td><?= h($laserMachineRate->date_created) ?></td>
                    <td><?= h($laserMachineRate->date_modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $laserMachineRate->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $laserMachineRate->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $laserMachineRate->id], ['confirm' => __('Are you sure you want to delete # {0}?', $laserMachineRate->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
