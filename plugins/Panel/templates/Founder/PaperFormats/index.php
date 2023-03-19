<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\Cake\Datasource\EntityInterface> $paperFormats
 */
?>
<div class="paperFormats index content">
    <?= $this->Html->link(__('New Paper Format'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Paper Formats') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('width') ?></th>
                    <th><?= $this->Paginator->sort('height') ?></th>
                    <th><?= $this->Paginator->sort('date_created') ?></th>
                    <th><?= $this->Paginator->sort('date_modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($paperFormats as $paperFormat): ?>
                <tr>
                    <td><?= $this->Number->format($paperFormat->id) ?></td>
                    <td><?= $this->Number->format($paperFormat->width) ?></td>
                    <td><?= $this->Number->format($paperFormat->height) ?></td>
                    <td><?= h($paperFormat->date_created) ?></td>
                    <td><?= h($paperFormat->date_modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $paperFormat->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $paperFormat->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $paperFormat->id], ['confirm' => __('Are you sure you want to delete # {0}?', $paperFormat->id)]) ?>
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
