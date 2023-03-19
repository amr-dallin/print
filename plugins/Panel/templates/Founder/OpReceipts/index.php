<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\Cake\Datasource\EntityInterface> $opReceipts
 */
?>
<div class="opReceipts index content">
    <?= $this->Html->link(__('New Op Receipt'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Op Receipts') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('amount') ?></th>
                    <th><?= $this->Paginator->sort('date_receipted') ?></th>
                    <th><?= $this->Paginator->sort('date_created') ?></th>
                    <th><?= $this->Paginator->sort('date_modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($opReceipts as $opReceipt): ?>
                <tr>
                    <td><?= $this->Number->format($opReceipt->id) ?></td>
                    <td><?= h($opReceipt->title) ?></td>
                    <td><?= $this->Number->format($opReceipt->amount) ?></td>
                    <td><?= h($opReceipt->date_receipted) ?></td>
                    <td><?= h($opReceipt->date_created) ?></td>
                    <td><?= h($opReceipt->date_modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $opReceipt->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $opReceipt->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $opReceipt->id], ['confirm' => __('Are you sure you want to delete # {0}?', $opReceipt->id)]) ?>
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
