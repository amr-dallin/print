<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $paperType
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Paper Type'), ['action' => 'edit', $paperType->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Paper Type'), ['action' => 'delete', $paperType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $paperType->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Paper Types'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Paper Type'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="paperTypes view content">
            <h3><?= h($paperType->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($paperType->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($paperType->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Created') ?></th>
                    <td><?= h($paperType->date_created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Modified') ?></th>
                    <td><?= h($paperType->date_modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($paperType->description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
