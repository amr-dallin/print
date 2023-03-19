<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\Cake\Datasource\EntityInterface> $paperDensities
 */
?>
<div class="paperDensities index content">
    <?= $this->Html->link(__('New Paper Density'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Paper Densities') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('density') ?></th>
                    <th><?= $this->Paginator->sort('date_created') ?></th>
                    <th><?= $this->Paginator->sort('date_modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($paperDensities as $paperDensity): ?>
                <tr>
                    <td><?= $this->Number->format($paperDensity->id) ?></td>
                    <td><?= $this->Number->format($paperDensity->density) ?></td>
                    <td><?= h($paperDensity->date_created) ?></td>
                    <td><?= h($paperDensity->date_modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $paperDensity->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $paperDensity->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $paperDensity->id], ['confirm' => __('Are you sure you want to delete # {0}?', $paperDensity->id)]) ?>
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
