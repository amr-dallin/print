<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\Cake\Datasource\EntityInterface> $order
 */
$this->assign('title', __d('panel', 'Order #{0}', h($order->unique_id)));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Orders')],
    [
        'title' => __d('panel', '{0} orders', $this->Orders->statusList()[h($order->status)]),
        'url' => ['controller' => 'Orders', 'action' => 'index' . $this->Orders->navigationSlug(h($order->status))]
    ],
    ['title' => __d('panel', 'Order #{0}', h($order->unique_id))]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['orders']['by_status'][$this->Orders->navigationSlug(h($order->status))] = true;
echo $this->element('press_navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css(['datagrid/datatables/datatables.bundle', 'formplugins/select2/select2.bundle'], ['block' => true]);
echo $this->Html->script(['datagrid/datatables/datatables.bundle', 'formplugins/select2/select2.bundle'], ['block' => true]);
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
        dom:
            "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: [
            <?php if ($this->Orders->isNotCompletedStatus($order)): ?>
            {
                text: '<?= __d('panel', 'Create new') ?>',
                titleAttr: '<?= __d('panel', 'Create new product') ?>',
                className: 'btn-success btn-xs',
                action: function ( e, dt, button, config ) {
                    $('#js-order-product-create-modal').modal('show');
                }
            }
            <?php endif; ?>
        ],
        columnDefs: [{
            targets: [0, 6],
            orderable: false
        }],
        order: [[1, 'asc']]
    });

    $('#js-order-external-client-id').select2({
        dropdownParent: $('#js-order-specify-client-modal')
    });
    $('#js-order-internal-client-id').select2({
        dropdownParent: $('#js-order-specify-client-modal')
    });
    $('#js-order-product-contractor-id').select2({
        dropdownParent: $('#js-order-product-create-modal')
    });
    $('#js-order-product-product-type').select2({
        dropdownParent: $('#js-order-product-create-modal')
    });    

    var $orderProductType = $('#js-order-product-create-modal input[type=radio][name=type]');
    var $orderProductContractorContainer = $('#js-create-order-product-contractor-container');
    $orderProductType.on('change', function(){
        if (this.value == '<?= ORDER_PRODUCTS_TYPE_INDEPENDENTLY ?>') {
            $orderProductContractorContainer.addClass('d-none');
            $orderProductContractorContainer.find('input, select').prop('disabled', true);
        } else if (this.value == '<?= ORDER_PRODUCTS_TYPE_OUTSOURCING ?>') {
            $orderProductContractorContainer.removeClass('d-none');
            $orderProductContractorContainer.find('input, select').prop('disabled', false);
        }
    });

    var $orderClientType = $('#js-order-specify-client-modal input[type=radio][name=client_type]');
    var $orderExternalClientContainer = $('#js-order-external-client-container');
    var $orderInternalClientContainer = $('#js-order-internal-client-container');
    $orderClientType.on('change', function(){
        if (this.value == '<?= CLIENTS_TYPE_EXTERNAL ?>') {
            $orderInternalClientContainer.addClass('d-none');
            $orderInternalClientContainer.find('select').prop('disabled', true);
            $orderExternalClientContainer.removeClass('d-none');
            $orderExternalClientContainer.find('select').prop('disabled', false);
        } else if (this.value == '<?= CLIENTS_TYPE_INTERNAL ?>') {
            $orderInternalClientContainer.removeClass('d-none');
            $orderInternalClientContainer.find('select').prop('disabled', false);
            $orderExternalClientContainer.addClass('d-none');
            $orderExternalClientContainer.find('select').prop('disabled', true);
        }
    });
});
</script>
<?php $this->end(); ?>


<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-bags-shopping"></i> <?= __d('panel', 'Order #{0}', h($order->unique_id)) ?>
    </h1>
</div>

<?php if ($this->Orders->isTransferToInProgressStatus($order)): ?>
<div class="alert bg-fusion-400 fade show">
    <div class="d-flex align-items-center">
        <div class="alert-icon">
            <i class="fal fa-shield-check text-warning"></i>
        </div>
        <div class="flex-1">
            <span class="h5"><?= __d('panel', 'Start working on an order') ?></span>
        </div>
        <?php
        echo $this->Form->postLink(
            __d('panel', 'In progress'),
            $this->Url->build(['controller' => 'Orders', 'action' => 'inProgress', h($order->id)]),
            [
                'class' => 'btn btn-warning btn-w-m fw-500 btn-sm',
                'data-title' => __d('panel', 'Are you sure you want to transport the order for fulfillment?'),
                'data-message' => __d('panel', 'Deletion eliminates the possibility of data recovery.')
            ]
        );
        ?>
    </div>
</div>

<?php elseif ($this->Orders->isEstimatedStatus($order)): ?>
<div class="alert alert-warning alert-dismissible fade show">
    <div class="d-flex align-items-center">
        <div class="alert-icon width-6">
            <span class="icon-stack icon-stack-lg">
                <i class="base-2 icon-stack-3x color-warning-400"></i>
                <i class="base-10 text-white icon-stack-1x"></i>
                <i class="ni md-profile color-warning-800 icon-stack-2x"></i>
            </span>
        </div>
        <div class="flex-1">
            <span class="h2"><?= __d('panel', 'The order is in estimated status') ?></span>
            <br>
            <?= __d('panel', 'To transfer an order to production, you must add products, production processes, a customer, a due date, and an order acceptance date.') ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if($this->Orders->isInProgressStatus($order)): ?>
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <div class="d-flex align-items-center">
        <div class="alert-icon">
            <span class="icon-stack icon-stack-md">
                <i class="base-2 icon-stack-3x color-info-400"></i>
                <i class="base-10 text-white icon-stack-1x"></i>
                <i class="ni md-profile color-info-800 icon-stack-2x"></i>
            </span>
        </div>
        <div class="flex-1">
            <span class="h2"><?= __d('panel', 'Order in production') ?></span>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if($this->Orders->isStatementCompletedStatus($order)): ?>
<div class="alert alert-warning fade show">
    <div class="d-flex align-items-center">
        <div class="alert-icon">
            <i class="fal fa-shield-check text-warning"></i>
        </div>
        <div class="flex-1">
            <span class="h5"><?= __d('panel', 'Order Completion') ?></span>
        </div>
        <button type="button" class="btn btn-warning btn-w-m fw-500 btn-sm" data-toggle="modal" data-target="#js-order-completed-modal">
            <?= __d('panel', 'Completed') ?>
        </button>
    </div>
</div>
<div class="modal fade" id="js-order-completed-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <?= $this->Form->create($order, ['url' => ['action' => 'completed', h($order->id)]]) ?>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?= __d('panel', 'Order Completion Date') ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <?php
                        echo $this->Form->control('date_completed', [
                            'label' => __d('panel', 'Date completed') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                            'escape' => false,
                            'required' => true
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
<?php endif; ?>

<?php if($this->Orders->isCompletedStatus($order)): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <div class="d-flex align-items-center">
        <div class="alert-icon width-3">
            <span class="icon-stack icon-stack-sm">
                <i class="base-2 icon-stack-3x color-success-600"></i>
                <i class="base-10 text-white icon-stack-1x"></i>
                <i class="ni md-profile color-success-800 icon-stack-2x"></i>
            </span>
        </div>
        <div class="flex-1">
            <span class="h2"><?= __d('panel', 'Order completed') ?></span>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if ($this->Orders->isProblemStatus($order)): ?>
<div class="alert bg-danger-600 alert-dismissible fade show">
    <div class="d-flex align-items-center">
        <div class="alert-icon width-8">
            <span class="icon-stack icon-stack-xl">
                <i class="base-2 icon-stack-3x color-danger-400"></i>
                <i class="base-10 text-white icon-stack-1x"></i>
                <i class="ni md-profile color-danger-800 icon-stack-2x"></i>
            </span>
        </div>
        <div class="flex-1 pl-1">
            <span class="h2"><?= __d('panel', 'There were problems with the order') ?></span>
            <br>
            <?= __d('panel', 'See below for more details.') ?>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <div class="panel-toolbar ml-auto mr-3">
                    <?php if ($this->Orders->isNotCompletedStatus($order)): ?>

                    <button type="button" class="btn btn-xs btn-info mr-2" data-toggle="modal" data-target="#js-order-date-modal">
                        <i class="fal fa-calendar-alt mr-1"></i>
                        <?= __d('panel', 'Date') ?>
                    </button>
                    <div class="modal fade" id="js-order-date-modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <?= $this->Form->create($order, ['url' => ['action' => 'edit', h($order->id)]]) ?>
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><?= __d('panel', 'Specify the time frame of the order') ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <?php
                                            echo $this->Form->control('date_accepted', [
                                                'label' => __d('panel', 'Date accepted') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                'escape' => false,
                                                'required' => true
                                            ]);
                                            echo $this->Form->control('date_deadline', [
                                                'label' => __d('panel', 'Date deadline') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                'escape' => false,
                                                'required' => true
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

                    <button type="button" class="btn btn-xs btn-warning mr-2" data-toggle="modal" data-target="#js-order-edit-modal">
                        <i class="fal fa-pencil mr-1"></i>
                        <?= __d('panel', 'Detail') ?>
                    </button>
                    <div class="modal fade" id="js-order-edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <?= $this->Form->create($order, ['url' => ['action' => 'edit', h($order->id)]]) ?>
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><?= __d('panel', 'Order Details') ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <?php
                                            echo $this->Form->control('title', [
                                                'label' => __d('panel', 'Title')
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
                    <?php endif; ?>

                    <?php
                    echo $this->Form->postLink(
                        $this->Html->tag('i', '', ['class' => 'fal fa-trash mr-1']) . __d('panel', 'Delete'),
                        $this->Url->build(['controller' => 'Orders', 'action' => 'delete', h($order->id)]),
                        [
                            'class' => 'btn btn-xs btn-danger mr-1',
                            'data-title' => __d('panel', 'Are you sure you want to delete the order?'),
                            'data-message' => __d('panel', 'Deletion eliminates the possibility of data recovery.')
                        ]
                    );
                    ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="row">
                        <div class="col-md-8">
                            <?php if ($this->Orders->specifiedDate($order)): ?>
                            <div class="alert alert-secondary">
                                <dl class="row fs-xl mb-0">
                                    <?php if (!empty($order->date_accepted)): ?>
                                    <dt class="col-md-3"><?= __d('panel', 'Date accepted') ?></dt>
                                    <dd class="col-md-9"><?= $order->date_accepted->format('d.m.Y H:i:s') ?></dd>
                                    <?php endif; ?>

                                    <?php if (!empty($order->date_deadline)): ?>
                                    <dt class="col-md-3"><?= __d('panel', 'Deadline') ?></dt>
                                    <dd class="col-md-9 mb-0"><?= $order->date_deadline->format('d.m.Y H:i:s') ?></dd>
                                    <?php endif; ?>

                                    <?php if (!empty($order->date_completed)): ?>
                                    <dt class="col-md-3 mt-3"><?= __d('panel', 'Date completed') ?></dt>
                                    <dd class="col-md-9 mt-0 mt-md-3 mb-0"><?= $order->date_completed->format('d.m.Y H:i:s') ?></dd>
                                    <?php endif; ?>
                                </dl>
                            </div>
                            <hr/>
                            <?php endif; ?>

                            <dl class="row fs-xl p-3">
                                <?php if (!empty($order->title)): ?>
                                <dt class="col-md-3"><?= __d('panel', 'Title') ?></dt>
                                <dd class="col-md-9"><?= h($order->title) ?></dd>
                                <?php endif; ?>
                                <?php if (!empty($order->description)): ?>
                                <dt class="col-md-3"><?= __d('panel', 'Description') ?></dt>
                                <dd class="col-md-9"><?= h($order->description) ?></dd>
                                <?php endif; ?>
                            </dl>
                        </div>
                        <div class="col-md-4">
                            <div class="card shadow-none">
                                <div class="card-header bg-warning-50 py-2 d-flex align-items-center flex-wrap">
                                    <div class="card-title"><?= __d('panel', 'Client') ?></div>
                                    <?php if ($this->Orders->isNotCompletedStatus($order)): ?>
                                    <button type="button" class="btn btn-xs btn-success ml-auto" data-toggle="modal" data-target="#js-order-specify-client-modal">
                                        <?= __d('panel', 'Specify client') ?>
                                    </button>
                                    <div class="modal fade" id="js-order-specify-client-modal" tabindex="-1" role="dialog" aria-hidden="true">
                                        <?= $this->Form->create($order, ['url' => ['action' => 'specifyClient', h($order->id)]]) ?>
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?= __d('panel', 'Specify client') ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12 mb-3">
                                                            <?php
                                                            echo $this->Form->control('client_type', [
                                                                'type' => 'radio',
                                                                'label' => __d('panel', 'Client type') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                'escape' => false,
                                                                'required' => true,
                                                                'options' => $this->Clients->typeList(),
                                                                'default' => CLIENTS_TYPE_INTERNAL
                                                            ]);
                                                            ?>

                                                            <div id="js-order-external-client-container" class="d-none">
                                                                <?php
                                                                echo $this->Form->control('client_id', [
                                                                    'label' => __d('panel', 'External client') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                    'escape' => false,
                                                                    'required' => true,
                                                                    'empty' => __d('panel', 'Select external client'),
                                                                    'id' => 'js-order-external-client-id',
                                                                    'class' => 'select2',
                                                                    'options' => $externalClients,
                                                                    'disabled' => true
                                                                ]);
                                                                ?>
                                                            </div>

                                                            <div id="js-order-internal-client-container">
                                                                <?php
                                                                echo $this->Form->control('client_id', [
                                                                    'label' => __d('panel', 'Internal client') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                    'escape' => false,
                                                                    'required' => true,
                                                                    'empty' => __d('panel', 'Select internal client'),
                                                                    'id' => 'js-order-internal-client-id',
                                                                    'class' => 'select2',
                                                                    'options' => $internalClients,
                                                                ]);
                                                                ?>
                                                            </div>
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
                                    <?php endif; ?>
                                </div>
                                <div class="card-body">
                                    <?php if($this->Orders->specifiedClient($order)): ?>
                                    <dl class="row fs-lg mb-0">
                                        <dt class="col-md-5"><?= __d('panel', 'Title') ?></dt>
                                        <dd class="col-md-7">
                                            <?php
                                            echo $this->Html->link(h($order->client->title),
                                                ['controller' => 'Clients', 'action' => 'view', h($order->client->id)]
                                            );
                                            ?>
                                        </dd>
                                        <dt class="col-md-5"><?= __d('panel', 'Type') ?></dt>
                                        <dd class="col-md-7"><?= $this->Clients->typeIcon($order->client->type) ?></dd>
                                    </dl>
                                    <hr/>
                                    <dl class="row fs-lg mb-0">
                                        <dt class="col-md-5"><?= __d('panel', 'Full name') ?></dt>
                                        <dd class="col-md-7"><?= h($order->client_full_name) ?></dd>
                                        <dt class="col-md-5"><?= __d('panel', 'Phone number') ?></dt>
                                        <dd class="col-md-7">
                                            <?php
                                            echo $this->Html->link(
                                                $order->client_telephone,
                                                'tel:' . $order->client_telephone
                                            );
                                            ?>
                                        </dd>
                                        <?php
                                        if (
                                            $order->client_telephone == $order->client->representative->phone_number->full_number &&
                                            $this->PhoneNumbers->isTelegram($order->client->representative->phone_number->is_telegram)
                                        ):
                                        ?>
                                        <dt class="col-md-5"><?= __d('panel', 'Telegram') ?></dt>
                                        <dd class="col-md-7">
                                            <?php
                                            echo $this->Html->link(
                                                $this->Html->tag('i', '', ['class' => 'fab fa-telegram']),
                                                'https://t.me/' . $order->client_telephone,
                                                ['target' => '_blank', 'escape' => false, 'class' => 'fs-xxl']
                                            );
                                            ?>
                                        </dd>
                                        <?php endif; ?>
                                    </dl>
                                    <?php else: ?>
                                        <div class="text-center text-info"><?= __d('panel', 'The client is not specified. Please indicate the client.') ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <?php if (!empty($order->cost_price)): ?>
                    <hr class="my-3" />
                    <div class="row">
                        <div class="col-lg-6 mb-3 mb-lg-0">
                            <div class="p-3 bg-warning-400 rounded overflow-hidden position-relative text-white">
                                <div>
                                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                        <?= $this->Number->currency($order->cost_price, 'UZS') ?>
                                        <small class="m-0 l-h-n"><?= __d('panel', 'Cost price') ?></small>
                                    </h3>
                                </div>
                                <i class="fal fa-gem position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4" style="font-size: 6rem;"></i>
                            </div>
                        </div>

                        <?php if ($this->Orders->specifiedClient($order)): ?>
                        <div class="col-lg-6 mb-3 mb-lg-0">

                            <?php if ($this->Clients->isInternal($order->client->type)): ?>
                            <div class="p-3 bg-success-200 rounded overflow-hidden position-relative text-white">
                                <div>
                                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                        <?= $this->Orders->savedPriceView($order) ?>
                                        <small class="m-0 l-h-n"><?= __d('panel', 'Saving') ?></small>
                                    </h3>
                                </div>
                                <i class="fal fa-lightbulb position-absolute pos-right pos-bottom opacity-15 mb-n5 mr-n6" style="font-size: 8rem;"></i>
                            </div>
                            <?php endif; ?>

                            <?php if ($this->Clients->isExternal($order->client->type)): ?>
                            <div class="p-3 bg-success-200 rounded overflow-hidden position-relative text-white">
                                <div class="">
                                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                        <?= $this->Orders->profitPriceView($order) ?>
                                        <small class="m-0 l-h-n"><?= __d('panel', 'Profit') ?></small>
                                    </h3>
                                </div>
                                <i class="fal fa-lightbulb position-absolute pos-right pos-bottom opacity-15 mb-n5 mr-n6" style="font-size: 8rem;"></i>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <hr />

                    <div class="row">
                        <div class="col-12">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#order-products-tab" role="tab">
                                        <i class="fab fa-product-hunt mr-1"></i> <?= __d('panel', 'Products') ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#order-invoice-tab" role="tab">
                                        <i class="fal fa-file-invoice mr-1"></i> <?= __d('panel', 'Invoice') ?>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content border border-top-0 p-3">
                                <div class="tab-pane fade show active" id="order-products-tab" role="tabpanel">
                                    <?php if ($this->Orders->isNotCompletedStatus($order)): ?>
                                    <div class="modal fade" id="js-order-product-create-modal" tabindex="-1" role="dialog" aria-hidden="true">
                                        <?= $this->Form->create($orderProduct, ['url' => ['controller' => 'OrderProducts', 'action' => 'add']]) ?>
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?= __d('panel', 'Create order product') ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12 mb-3">
                                                            <?php
                                                            echo $this->Form->control('order_id', [
                                                                'type' => 'hidden',
                                                                'value' => h($order->id)
                                                            ]);
                                                            echo $this->Form->control('type', [
                                                                'label' => __d('panel', 'Manufacturer') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                'type' => 'radio',
                                                                'escape' => false,
                                                                'options' => $this->OrderProducts->typeList(),
                                                                'default' => ORDER_PRODUCTS_TYPE_INDEPENDENTLY
                                                            ]);
                                                            ?>

                                                            <div id="js-create-order-product-contractor-container" class="d-none">
                                                                <div class="row mb-3">
                                                                    <div class="col-md-8 mb-3 mb-md-0">
                                                                        <?php
                                                                        echo $this->Form->control('contractor_id', [
                                                                            'empty' => __d('panel', 'Select contractor'),
                                                                            'label' => __d('panel', 'Contractors') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                            'id' => 'js-order-product-contractor-id',
                                                                            'options' => $contractors,
                                                                            'escape' => false,
                                                                            'disabled' => true,
                                                                            'required' => true
                                                                        ]);
                                                                        ?>
                                                                    </div>
                                                                    <div class="col-md-4 mb-3 mb-md-0">
                                                                        <?php
                                                                        echo $this->Form->control('cost_price', [
                                                                            'label' => __d('panel', 'Cost price') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                            'escape' => false,
                                                                            'id' => 'js-order-product-cost-price',
                                                                            'disabled' => true,
                                                                            'required' => true
                                                                        ]);
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <hr/>

                                                            <?php
                                                            echo $this->Form->control('title', [
                                                                'label' => __d('panel', 'Title') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                'escape' => false,
                                                                'required' => true
                                                            ]);
                                                            echo $this->Form->control('quantity', [
                                                                'label' => __d('panel', 'Quantity') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                'escape' => false,
                                                                'required' => true
                                                            ]);
                                                            echo $this->Form->control('product_type_id', [
                                                                'empty' => __d('panel', 'Select product type'),
                                                                'label' => __d('panel', 'Product type') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                'escape' => false,
                                                                'id' => 'js-order-product-product-type',
                                                                'required' => true
                                                            ]);
                                                            echo $this->Form->control('description', [
                                                                'label' => __d('panel', 'Description')
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
                                    <?php endif; ?>

                                    <table class="table table-bordered table-hover table-striped w-100 datatable">
                                        <thead>
                                            <tr>
                                                <th class="all"></th>
                                                <th class="all text-center"><?= __d('panel', 'ID') ?></th>
                                                <th class="all text-center"><?= __d('panel', 'Manufacturer') ?></th>
                                                <th class="min-tablet text-center"><?= __d('panel', 'Product type') ?></th>
                                                <th class="min-desktop"><?= __d('panel', 'Title') ?></th>
                                                <th class="all text-center"><?= __d('panel', 'Status') ?></th>
                                                <th class="all"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($order->order_products as $orderProduct): ?>
                                            <tr>
                                                <td class="text-center">
                                                    <?php
                                                    if ($this->Orders->isNotCompletedStatus($order)) {
                                                        echo $this->Form->postLink(
                                                            $this->Html->tag('i', '', ['class' => 'fal fa-trash']),
                                                            $this->Url->build(['controller' => 'OrderProducts', 'action' => 'delete', h($orderProduct->id)]),
                                                            [
                                                                'class' => 'color-danger-900',
                                                                'data-title' => __d('panel', 'Are you sure you want to delete the order product?'),
                                                                'data-message' => __d('panel', 'Deletion eliminates the possibility of data recovery.')
                                                            ]
                                                        );
                                                    }

                                                    ?>
                                                </td>
                                                <td class="text-center"><?= h($orderProduct->unique_id) ?></td>
                                                <td class="text-center"><?= $this->OrderProducts->typeIcon($orderProduct->type) ?></td>
                                                <td class="text-center"><?= h($orderProduct->product_type->title) ?></td>
                                                <td><?= h($orderProduct->title) ?></td>
                                                <td class="text-center">
                                                    <?= $this->OrderProducts->statusIcon($orderProduct->status) ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    echo $this->Html->link(
                                                        $this->Html->tag('i', '', ['class' => 'fal fa-eye']),
                                                        ['controller' => 'OrderProducts', 'action' => 'view', h($orderProduct->id)],
                                                        ['escape' => false]
                                                    );
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="order-invoice-tab" role="tabpanel">
                                    <div class="text-center text-info my-1"><?= __d('panel', 'On development stage') ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>