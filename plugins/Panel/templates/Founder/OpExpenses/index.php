<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\Cake\Datasource\EntityInterface> $opExpenses
 */
?>
<div class="opExpenses index content">
    <?= $this->Html->link(__('New Op Expense'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Op Expenses') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('amount') ?></th>
                    <th><?= $this->Paginator->sort('date_expensed') ?></th>
                    <th><?= $this->Paginator->sort('date_created') ?></th>
                    <th><?= $this->Paginator->sort('date_modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($opExpenses as $opExpense): ?>
                <tr>
                    <td><?= $this->Number->format($opExpense->id) ?></td>
                    <td><?= h($opExpense->title) ?></td>
                    <td><?= $this->Number->format($opExpense->amount) ?></td>
                    <td><?= h($opExpense->date_expensed) ?></td>
                    <td><?= h($opExpense->date_created) ?></td>
                    <td><?= h($opExpense->date_modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $opExpense->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $opExpense->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $opExpense->id], ['confirm' => __('Are you sure you want to delete # {0}?', $opExpense->id)]) ?>
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
