<?php
$this->assign('title', __d('panel', 'Cash register statistics'));
$this->assign('breadcrumbs', $this->element('breadcrumbs'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Cash register')],
    ['title' => __d('panel', 'Statistics')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['cash_register']['statistics'] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();
?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-chart-area"></i> <?= __d('panel', 'Cash register statistics') ?>
    </h1>
</div>

<div class="row">
    <div class="col-lg-4">
        <?= $this->cell('Founder/CashRegister::totalReceipts') ?>
    </div>
    <div class="col-lg-4">
        <?= $this->cell('Founder/CashRegister::totalExpenses') ?>
    </div>
    <div class="col-lg-4">
        <?= $this->cell('Founder/CashRegister::balance') ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Last 10 receipts') ?></h2>
                <div class="panel-toolbar ml-auto mr-3">
                    <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#js-op-receipt-create-model"><?= __d('panel', 'Create') ?></button>
                    <div class="modal fade" id="js-op-receipt-create-model" tabindex="-1" role="dialog" aria-hidden="true">
                        <?= $this->Form->create($opReceipt, ['url' => ['controller' => 'OpReceipts', 'action' => 'add']]) ?>
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><?= __d('panel', 'Create receipt') ?></h4>
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
                                            echo $this->Form->control('date_receipted', [
                                                'label' => __d('panel', 'Date receipted') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
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
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <?= $this->cell('Founder/OpReceipts::last') ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div id="panel-2" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Last 10 expenses') ?></h2>
                <div class="panel-toolbar ml-auto mr-3">
                    <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#js-op-expense-create-model"><?= __d('panel', 'Create') ?></button>
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
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <?= $this->cell('Founder/OpExpenses::last') ?>
                </div>
            </div>
        </div>
    </div>
</div>