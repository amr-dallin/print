<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\Cake\Datasource\EntityInterface> $paperColors
 */
?>
<div class="paperColors index content">
    <?= $this->Html->link(__('New Paper Color'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Paper Colors') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('date_created') ?></th>
                    <th><?= $this->Paginator->sort('date_modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($paperColors as $paperColor): ?>
                <tr>
                    <td><?= $this->Number->format($paperColor->id) ?></td>
                    <td><?= h($paperColor->title) ?></td>
                    <td><?= h($paperColor->date_created) ?></td>
                    <td><?= h($paperColor->date_modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $paperColor->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $paperColor->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $paperColor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $paperColor->id)]) ?>
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
