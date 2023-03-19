<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\Cake\Datasource\EntityInterface> $expenses
 */
$this->assign('title', __d('panel', 'Expenses'));

$this->start('breadcrumbs');
$breadcrumbs[] = ['title' => __d('panel', 'Storage')];
if (null !== $this->request->getQuery('range')) {
    $breadcrumbs[] = ['title' => __d('panel', 'Expenses'), 'url' => ['action' => 'index']];
    $breadcrumbs[] = ['title' => $this->request->getQuery('range')];
} else {
    $breadcrumbs[] = ['title' => __d('panel', 'Expenses')];
}
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['storage']['expenses'] = true;
echo $this->element('press_navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css([
    'datagrid/datatables/datatables.bundle',
    'formplugins/bootstrap-daterangepicker/bootstrap-daterangepicker',
    'formplugins/select2/select2.bundle'
], ['block' => true]);
echo $this->Html->script([
    'datagrid/datatables/datatables.bundle',
    'formplugins/bootstrap-daterangepicker/bootstrap-daterangepicker',
    'formplugins/select2/select2.bundle'
], ['block' => true]);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function() {
    $('.datatable').dataTable({
        pageLength: 25,
        responsive: {
            details: {
                type: 'column', target: 'tr'
            }
        },
        columnDefs: [{
            targets: [0, 6],
            orderable: false
        }],
        order: [[3, 'desc']]
    });

    $('#custom-range').daterangepicker(
    {
        "showDropdowns": true,
        "showWeekNumbers": true,
        "showISOWeekNumbers": true,
        "autoApply": true,
        ranges:
        {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        locale: {
            format: 'DD.MM.Y'
        },
    }, function(start, end, label)
    {
        console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });

    $('.select2').select2();

    $('#js-foreign-key-paper-id').select2({
        dropdownParent: $('#js-expense-paper-create-modal')
    });
    $('#js-foreign-key-consumable-id').select2({
        dropdownParent: $('#js-expense-consumable-create-modal')
    });
});
</script>
<?php $this->end(); ?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-table"></i> <?= __d('panel', 'Expenses') ?>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <div class="panel-toolbar ml-auto mr-3">
                    <button type="button" class="btn btn-xs btn-success mr-2" data-toggle="modal" data-target="#js-expense-paper-create-modal"><?= __d('panel', 'Paper') ?></button>
                    <div class="modal fade" id="js-expense-paper-create-modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <?= $this->Form->create($expense, ['url' => ['controller' => 'Expenses', 'action' => 'add']]) ?>
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><?= __d('panel', 'Add expense') ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <?php
                                            echo $this->Form->control('foreign_key', [
                                                'label' => __d('panel', 'Paper') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                'id' => 'js-foreign-key-paper-id',
                                                'class' => 'select2',
                                                'options' => $papers,
                                                'escape' => false
                                            ]);
                                            echo $this->Form->control('model', [
                                                'type' => 'hidden',
                                                'value' => 'Papers'
                                            ]);
                                            ?>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <?php
                                            echo $this->Form->control('quantity', [
                                                'label' => __d('panel', 'Quantity') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                'escape' => false
                                            ]);
                                            ?>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <?php
                                            echo $this->Form->control('date_expensed', [
                                                'label' => __d('panel', 'Date expensed') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                'escape' => false
                                            ]);
                                            ?>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <?php
                                            echo $this->Form->control('description', [
                                                'placeholder' => __d('panel', 'Description'),
                                                'rows' => 2
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= __d('panel', 'Close') ?></button>
                                    <?= $this->Form->submit(__d('panel', 'Save')) ?>
                                </div>
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>

                    <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#js-expense-consumable-create-modal"><?= __d('panel', 'Consumable') ?></button>
                    <div class="modal fade" id="js-expense-consumable-create-modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <?= $this->Form->create($expense, ['url' => ['controller' => 'Expenses', 'action' => 'add']]) ?>
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><?= __d('panel', 'Add expense') ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <?php
                                            echo $this->Form->control('foreign_key', [
                                                'label' => __d('panel', 'Consumable') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                'id' => 'js-foreign-key-consumable-id',
                                                'class' => 'select2',
                                                'options' => $consumables,
                                                'escape' => false
                                            ]);
                                            echo $this->Form->control('model', [
                                                'type' => 'hidden',
                                                'value' => 'Consumables'
                                            ]);
                                            ?>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <?php
                                            echo $this->Form->control('quantity', [
                                                'label' => __d('panel', 'Quantity') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                'escape' => false
                                            ]);
                                            ?>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <?php
                                            echo $this->Form->control('date_expensed', [
                                                'label' => __d('panel', 'Date expensed') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                'escape' => false
                                            ]);
                                            ?>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <?php
                                            echo $this->Form->control('description', [
                                                'placeholder' => __d('panel', 'Description'),
                                                'rows' => 2
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= __d('panel', 'Close') ?></button>
                                    <?= $this->Form->submit(__d('panel', 'Save')) ?>
                                </div>
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <form>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="range" class="form-control form-control-lg" id="custom-range" value="<?= $this->request->getQuery('range') ?>" aria-describedby="button-addon5">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" id="button-addon5"><i class="fal fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr/>

                    <?php if (!empty($expenses)): ?>
                    <table class="table table-bordered table-hover table-striped w-100 datatable">
                        <thead>
                            <tr>
                                <th class="all"></th>
                                <th class="all text-center"><?= __d('panel', 'Type') ?></th>
                                <th class="all"><?= __d('panel', 'Title') ?></th>
                                <th class="min-mobile"><?= __d('panel', 'Date expensed') ?></th>
                                <th class="all text-center"><?= __d('panel', 'Quantity') ?></th>
                                <th class="all text-center"><?= __d('panel', 'Unit') ?></th>
                                <th class="all"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($expenses as $expense): ?>
                            <tr>
                                <td class="text-center">
                                    <?php
                                    echo $this->Form->postLink(
                                        $this->Html->tag('i', '', ['class' => 'fal fa-trash']),
                                        $this->Url->build(['controller' => 'PurchaseEntities', 'action' => 'delete', h($expense->id)]),
                                        [
                                            'class' => 'color-danger-900',
                                            'data-title' => __d('panel', 'Are you sure you want to delete the expense?'),
                                            'data-message' => __d('panel', 'Deletion eliminates the possibility of data recovery.')
                                        ]
                                    );
                                    ?>
                                </td>
                                <td class="text-center"><?= $this->Materials->modelIcon($expense) ?></td>
                                <td>
                                    <?php
                                    if ($this->Expenses->isPaper($expense->model)) {
                                        echo $this->Html->link(
                                            $expense->title,
                                            ['controller' => 'Papers', 'action' => 'view', h($expense->foreign_key)]
                                        );
                                    } elseif ($this->Expenses->isConsumable($expense->model)) {
                                        echo $this->Html->link(
                                            $expense->title,
                                            ['controller' => 'Consumables', 'action' => 'view', h($expense->foreign_key)]
                                        );
                                    }
                                    ?>
                                </td>
                                <td data-order="<?= $expense->date_expensed->format('c') ?>">
                                    <?= $expense->date_expensed->format('d.m.Y') ?>
                                </td>
                                <td class="text-center fs-lg fw-700"><?= $expense->quantity ?></td>
                                <td>
                                    <?php
                                    if ($expense->model == 'Papers') {
                                        echo "{$expense->paper->initial_unit->title} ({$expense->paper->quantity} {$expense->paper->unit->title})";
                                    } elseif ($expense->model == 'Consumables') {
                                        echo $this->Consumables->unit($expense->consumable);
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="#" class="d-block text-center" data-toggle="modal" data-target="#js-expense_edit_modal-<?= h($expense->id) ?>">
                                        <i class="fal fa-pencil"></i>
                                    </a>
                                    <div class="modal fade" id="js-expense_edit_modal-<?= h($expense->id) ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                        <?= $this->Form->create($expense, ['url' => ['controller' => 'Expenses', 'action' => 'edit', h($expense->id)]]) ?>
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?= __d('panel', 'Edit expense') ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="alert alert-secondary">
                                                                <dl class="row mb-0">
                                                                    <dt class="col-md-2"><?= __d('panel', 'Type') ?></dt>
                                                                    <dd class="col-md-10">
                                                                        <?= $this->Materials->modelIcon($expense) ?>
                                                                    </dd>
                                                                    <dt class="col-md-2"><?= __d('panel', 'Title') ?></dt>
                                                                    <dd class="col-md-10 mb-0"><?= h($expense->title) ?></dd>
                                                                </dl>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <?php
                                                            echo $this->Form->control('quantity', [
                                                                'label' => __d('panel', 'Quantity') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                'escape' => false
                                                            ]);
                                                            ?>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <?php
                                                            echo $this->Form->control('date_expensed', [
                                                                'label' => __d('panel', 'Date expensed') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                'escape' => false
                                                            ]);
                                                            ?>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <?php
                                                            echo $this->Form->control('description', [
                                                                'placeholder' => __d('panel', 'Description'),
                                                                'rows' => 2
                                                            ]);
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= __d('panel', 'Close') ?></button>
                                                    <?= $this->Form->submit(__d('panel', 'Save')) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?= $this->Form->end() ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                        <?= $this->Html->tag('div', __('There were no expenses during this time period.'), ['class' => 'text-warning text-center my-3']) ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>