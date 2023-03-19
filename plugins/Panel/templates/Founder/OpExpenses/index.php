<?php
$this->assign('title', __d('panel', 'Cash register expenses'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Cash register')],
    ['title' => __d('panel', 'Expenses')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['cash_register']['expenses'] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css('datagrid/datatables/datatables.bundle', ['block' => true]);
echo $this->Html->script('datagrid/datatables/datatables.bundle', ['block' => true]);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function() {
    $('.datatable').dataTable({
        responsive: {
            details: {
                type: 'column', target: 'tr'
            }
        },
        columnDefs: [{
            targets: [0],
            orderable: false
        }],
        pageLength: 25,
        order: [[3, 'desc']]
    });
});
</script>
<?php $this->end(); ?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-align-left"></i> <?= __d('panel', 'Cash register expenses') ?>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Cash register expenses') ?></h2>
                <button type="button" class="btn btn-xs btn-success mr-3" data-toggle="modal" data-target="#js-op-expense-create-model"><?= __d('panel', 'Create') ?></button>
                <div class="modal fade" id="js-op-expense-create-model" tabindex="-1" role="dialog" aria-hidden="true">
                    <?= $this->Form->create($opExpense, ['url' => ['controller' => 'OpExpenses', 'action' => 'add']]) ?>
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><?= __d('panel', 'Create expense') ?></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <?php
                                        echo $this->Form->control('amount', [
                                            'label' => __d('panel', 'Amount') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
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
                                        echo $this->Form->control('title', [
                                            'label' => __d('panel', 'Title') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                            'escape' => false
                                        ]);
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
            <div class="panel-container show">
                <div class="panel-content">
                    <table class="table table-bordered table-hover table-striped w-100 datatable">
                        <thead>
                            <tr>
                                <th class="all"></th>
                                <th class="all"><?= __d('panel', 'Title') ?></th>
                                <th class="all"><?= __d('panel', 'Description') ?></th>
                                <th class="all text-center"><?= __d('panel', 'Date expensed') ?></th>
                                <th class="all text-right"><?= __d('panel', 'Amount'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($opExpenses as $opExpense): ?>
                            <tr>
                                <td class="text-center">
                                    <?php
                                    echo $this->Form->postLink(
                                        $this->Html->tag('i', '', ['class' => 'fal fa-trash']),
                                        $this->Url->build(['action' => 'delete', h($opExpense->id)]),
                                        [
                                            'class' => 'color-danger-900',
                                            'data-title' => __d('panel', 'Are you sure you want to delete the cash register expense?'),
                                            'data-message' => __d('panel', 'Deletion eliminates the possibility of data recovery.')
                                        ]
                                    );
                                    ?>
                                </td>
                                <td><?= $opExpense->title ?></td>
                                <td><?= $opExpense->description ?></td>
                                <td class="text-center" data-order="<?= $opExpense->date_expensed->format('c') ?>">
                                    <?= $opExpense->date_expensed->format('d.m.Y') ?>
                                </td>
                                <td class="text-right"><?= $this->Number->currency($opExpense->amount, 'UZS', ['locale' => 'uz_UZ']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
