<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $paperDensity
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Paper Density'), ['action' => 'edit', $paperDensity->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Paper Density'), ['action' => 'delete', $paperDensity->id], ['confirm' => __('Are you sure you want to delete # {0}?', $paperDensity->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Paper Densities'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Paper Density'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="paperDensities view content">
            <h3><?= h($paperDensity->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($paperDensity->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Density') ?></th>
                    <td><?= $this->Number->format($paperDensity->density) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Created') ?></th>
                    <td><?= h($paperDensity->date_created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Modified') ?></th>
                    <td><?= h($paperDensity->date_modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
