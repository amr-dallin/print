<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $opCollection
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Op Collection'), ['action' => 'edit', $opCollection->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Op Collection'), ['action' => 'delete', $opCollection->id], ['confirm' => __('Are you sure you want to delete # {0}?', $opCollection->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Op Collections'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Op Collection'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="opCollections view content">
            <h3><?= h($opCollection->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($opCollection->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date From') ?></th>
                    <td><?= h($opCollection->date_from) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date To') ?></th>
                    <td><?= h($opCollection->date_to) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Collection') ?></th>
                    <td><?= h($opCollection->date_collection) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Created') ?></th>
                    <td><?= h($opCollection->date_created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Modified') ?></th>
                    <td><?= h($opCollection->date_modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Confirmed') ?></th>
                    <td><?= $opCollection->confirmed ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Notes') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($opCollection->notes)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
