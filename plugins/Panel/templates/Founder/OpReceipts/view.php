<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $opReceipt
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Op Receipt'), ['action' => 'edit', $opReceipt->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Op Receipt'), ['action' => 'delete', $opReceipt->id], ['confirm' => __('Are you sure you want to delete # {0}?', $opReceipt->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Op Receipts'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Op Receipt'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="opReceipts view content">
            <h3><?= h($opReceipt->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($opReceipt->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($opReceipt->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Amount') ?></th>
                    <td><?= $this->Number->format($opReceipt->amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Receipted') ?></th>
                    <td><?= h($opReceipt->date_receipted) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Created') ?></th>
                    <td><?= h($opReceipt->date_created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Modified') ?></th>
                    <td><?= h($opReceipt->date_modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($opReceipt->description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
