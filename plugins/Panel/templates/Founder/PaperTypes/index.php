<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\Cake\Datasource\EntityInterface> $paperTypes
 */
$this->assign('title', __d('panel', 'Create paper type'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Paper types')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['directory']['paper']['types'] = true;
echo $this->element('press_navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css([], ['block' => true]);
echo $this->Html->script([], ['block' => true]);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function() {
    
});
</script>
<?php $this->end(); ?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-plus-circle"></i> <?= __d('panel', 'Create paper type') ?>
    </h1>
</div>

<div class="paperTypes index content">
    <?= $this->Html->link(__('New Paper Type'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Paper Types') ?></h3>
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
                <?php foreach ($paperTypes as $paperType): ?>
                <tr>
                    <td><?= $this->Number->format($paperType->id) ?></td>
                    <td><?= h($paperType->title) ?></td>
                    <td><?= h($paperType->date_created) ?></td>
                    <td><?= h($paperType->date_modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $paperType->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $paperType->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $paperType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $paperType->id)]) ?>
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
