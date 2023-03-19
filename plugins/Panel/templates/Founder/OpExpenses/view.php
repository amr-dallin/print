<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $opExpense
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Op Expense'), ['action' => 'edit', $opExpense->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Op Expense'), ['action' => 'delete', $opExpense->id], ['confirm' => __('Are you sure you want to delete # {0}?', $opExpense->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Op Expenses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Op Expense'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="opExpenses view content">
            <h3><?= h($opExpense->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($opExpense->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($opExpense->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Amount') ?></th>
                    <td><?= $this->Number->format($opExpense->amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Expensed') ?></th>
                    <td><?= h($opExpense->date_expensed) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Created') ?></th>
                    <td><?= h($opExpense->date_created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Modified') ?></th>
                    <td><?= h($opExpense->date_modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($opExpense->description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
