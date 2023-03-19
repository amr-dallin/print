<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $laserMachineRate
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Laser Machine Rate'), ['action' => 'edit', $laserMachineRate->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Laser Machine Rate'), ['action' => 'delete', $laserMachineRate->id], ['confirm' => __('Are you sure you want to delete # {0}?', $laserMachineRate->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Laser Machine Rates'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Laser Machine Rate'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="laserMachineRates view content">
            <h3><?= h($laserMachineRate->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($laserMachineRate->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Laser Machine Id') ?></th>
                    <td><?= $this->Number->format($laserMachineRate->laser_machine_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Default Pouring') ?></th>
                    <td><?= $this->Number->format($laserMachineRate->default_pouring) ?></td>
                </tr>
                <tr>
                    <th><?= __('Default Size') ?></th>
                    <td><?= $this->Number->format($laserMachineRate->default_size) ?></td>
                </tr>
                <tr>
                    <th><?= __('Toner C P') ?></th>
                    <td><?= $laserMachineRate->toner_c_p === null ? '' : $this->Number->format($laserMachineRate->toner_c_p) ?></td>
                </tr>
                <tr>
                    <th><?= __('Toner M P') ?></th>
                    <td><?= $laserMachineRate->toner_m_p === null ? '' : $this->Number->format($laserMachineRate->toner_m_p) ?></td>
                </tr>
                <tr>
                    <th><?= __('Toner Y P') ?></th>
                    <td><?= $laserMachineRate->toner_y_p === null ? '' : $this->Number->format($laserMachineRate->toner_y_p) ?></td>
                </tr>
                <tr>
                    <th><?= __('Toner K P') ?></th>
                    <td><?= $this->Number->format($laserMachineRate->toner_k_p) ?></td>
                </tr>
                <tr>
                    <th><?= __('Drum C P') ?></th>
                    <td><?= $laserMachineRate->drum_c_p === null ? '' : $this->Number->format($laserMachineRate->drum_c_p) ?></td>
                </tr>
                <tr>
                    <th><?= __('Drum M P') ?></th>
                    <td><?= $laserMachineRate->drum_m_p === null ? '' : $this->Number->format($laserMachineRate->drum_m_p) ?></td>
                </tr>
                <tr>
                    <th><?= __('Drum Y P') ?></th>
                    <td><?= $laserMachineRate->drum_y_p === null ? '' : $this->Number->format($laserMachineRate->drum_y_p) ?></td>
                </tr>
                <tr>
                    <th><?= __('Drum K P') ?></th>
                    <td><?= $this->Number->format($laserMachineRate->drum_k_p) ?></td>
                </tr>
                <tr>
                    <th><?= __('Developer C P') ?></th>
                    <td><?= $laserMachineRate->developer_c_p === null ? '' : $this->Number->format($laserMachineRate->developer_c_p) ?></td>
                </tr>
                <tr>
                    <th><?= __('Developer M P') ?></th>
                    <td><?= $laserMachineRate->developer_m_p === null ? '' : $this->Number->format($laserMachineRate->developer_m_p) ?></td>
                </tr>
                <tr>
                    <th><?= __('Developer Y P') ?></th>
                    <td><?= $laserMachineRate->developer_y_p === null ? '' : $this->Number->format($laserMachineRate->developer_y_p) ?></td>
                </tr>
                <tr>
                    <th><?= __('Developer K P') ?></th>
                    <td><?= $this->Number->format($laserMachineRate->developer_k_p) ?></td>
                </tr>
                <tr>
                    <th><?= __('Extra') ?></th>
                    <td><?= $laserMachineRate->extra === null ? '' : $this->Number->format($laserMachineRate->extra) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Commited') ?></th>
                    <td><?= h($laserMachineRate->date_commited) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Created') ?></th>
                    <td><?= h($laserMachineRate->date_created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Modified') ?></th>
                    <td><?= h($laserMachineRate->date_modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Current') ?></th>
                    <td><?= $laserMachineRate->is_current ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
