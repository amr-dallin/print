<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\Cake\Datasource\EntityInterface> $opCollections
 */
?>
<div class="opCollections index content">
    <?= $this->Html->link(__('New Op Collection'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Op Collections') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('date_from') ?></th>
                    <th><?= $this->Paginator->sort('date_to') ?></th>
                    <th><?= $this->Paginator->sort('date_collection') ?></th>
                    <th><?= $this->Paginator->sort('confirmed') ?></th>
                    <th><?= $this->Paginator->sort('date_created') ?></th>
                    <th><?= $this->Paginator->sort('date_modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($opCollections as $opCollection): ?>
                <tr>
                    <td><?= $this->Number->format($opCollection->id) ?></td>
                    <td><?= h($opCollection->date_from) ?></td>
                    <td><?= h($opCollection->date_to) ?></td>
                    <td><?= h($opCollection->date_collection) ?></td>
                    <td><?= h($opCollection->confirmed) ?></td>
                    <td><?= h($opCollection->date_created) ?></td>
                    <td><?= h($opCollection->date_modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $opCollection->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $opCollection->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $opCollection->id], ['confirm' => __('Are you sure you want to delete # {0}?', $opCollection->id)]) ?>
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
