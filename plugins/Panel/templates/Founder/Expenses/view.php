<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $expense
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Expense'), ['action' => 'edit', $expense->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Expense'), ['action' => 'delete', $expense->id], ['confirm' => __('Are you sure you want to delete # {0}?', $expense->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Expenses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Expense'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="expenses view content">
            <h3><?= h($expense->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Foreign Key') ?></th>
                    <td><?= h($expense->foreign_key) ?></td>
                </tr>
                <tr>
                    <th><?= __('Model') ?></th>
                    <td><?= h($expense->model) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($expense->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Quantity') ?></th>
                    <td><?= $this->Number->format($expense->quantity) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Expensed') ?></th>
                    <td><?= h($expense->date_expensed) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Created') ?></th>
                    <td><?= h($expense->date_created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Modified') ?></th>
                    <td><?= h($expense->date_modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($expense->description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
