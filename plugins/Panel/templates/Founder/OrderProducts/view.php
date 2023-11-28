<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\Cake\Datasource\EntityInterface> $orderProduct
 */
$this->assign('title', __d('panel', 'Product #{0} - order #{1}', h($orderProduct->unique_id), h($orderProduct->order->unique_id)));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Orders')],
    [
        'title' => __d('panel', '{0} orders', $this->Orders->statusList()[h($orderProduct->order->status)]),
        'url' => ['controller' => 'Orders', 'action' => 'index' . $this->Orders->navigationSlug(h($orderProduct->order->status))]
    ],
    [
        'title' => __d('panel', 'Order #{0}', h($orderProduct->order->unique_id)),
        'url' => ['controller' => 'Orders', 'action' => 'view', h($orderProduct->order->id)]
    ],
    ['title' => __d('panel', 'Product #{0}', h($orderProduct->unique_id))]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['orders']['by_status'][$this->Orders->navigationSlug(h($orderProduct->order->status))] = true;
echo $this->element('press_navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css(['datagrid/datatables/datatables.bundle', 'formplugins/select2/select2.bundle'], ['block' => true]);
echo $this->Html->script([
    'datagrid/datatables/datatables.bundle',
    'formplugins/select2/select2.bundle',
    'clipboard.min'
], ['block' => true]);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function() {
    $.fn.modal.Constructor.prototype._enforceFocus = function() {};
    new ClipboardJS('.copy');

    $('#js-product-process-postprint-action-contractor-id').select2({
        dropdownParent: $('#js-process-product-postprint-action-create-modal')
    });
    $('#js-product-process-postprint-action-price-id').select2({
        dropdownParent: $('#js-process-product-postprint-action-create-modal')
    });
    $('#js-product-process-preprint-action-contractor-id').select2({
        dropdownParent: $('#js-process-product-preprint-action-create-modal')
    });
    $('#js-product-process-preprint-action-price-id').select2({
        dropdownParent: $('#js-process-product-preprint-action-create-modal')
    });
    $('#js-product-process-laser-print-contractor-id').select2({
        dropdownParent: $('#js-process-product-laser-print-action-create-modal')
    });
    $('#js-order-product-contractor-id').select2({
        dropdownParent: $('#js-order-product-contractor-modal')
    });
    $('#js-order-product-product-type').select2({
        dropdownParent: $('#js-order-product-edit-modal')
    });    

    var $productProcessPreprintActionType = $('#js-process-product-preprint-action-create-modal input[type=radio][name=type]');
    var $productProcessPreprintActionContractorContainer = $('#js-product-process-preprint-action-contractor-container');
    var $productProcessPreprintDetailContainer = $('#js-product-process-preprint-detail-container');
    $productProcessPreprintActionType.on('change', function(){
        if (this.value == '<?= PRODUCT_PROCESSES_TYPE_INDEPENDENTLY ?>') {
            $productProcessPreprintActionContractorContainer.addClass('d-none');
            $productProcessPreprintActionContractorContainer.find('input, select').prop('disabled', true);

            $productProcessPreprintDetailContainer.removeClass('d-none');
            $productProcessPreprintDetailContainer.find('input, select').prop('disabled', false);
        } else if (this.value == '<?= PRODUCT_PROCESSES_TYPE_OUTSOURCING ?>') {
            $productProcessPreprintActionContractorContainer.removeClass('d-none');
            $productProcessPreprintActionContractorContainer.find('input, select').prop('disabled', false);

            $productProcessPreprintDetailContainer.addClass('d-none');
            $productProcessPreprintDetailContainer.find('input, select').prop('disabled', true);
        }
    });

    var $productProcessPostprintActionType = $('#js-process-product-postprint-action-create-modal input[type=radio][name=type]');
    var $productProcessPostprintActionContractorContainer = $('#js-product-process-postprint-action-contractor-container');
    var $productProcessPostprintDetailContainer = $('#js-product-process-postprint-detail-container');
    $productProcessPostprintActionType.on('change', function(){
        if (this.value == '<?= PRODUCT_PROCESSES_TYPE_INDEPENDENTLY ?>') {
            $productProcessPostprintActionContractorContainer.addClass('d-none');
            $productProcessPostprintActionContractorContainer.find('input, select').prop('disabled', true);

            $productProcessPostprintDetailContainer.removeClass('d-none');
            $productProcessPostprintDetailContainer.find('input, select').prop('disabled', false);
        } else if (this.value == '<?= PRODUCT_PROCESSES_TYPE_OUTSOURCING ?>') {
            $productProcessPostprintActionContractorContainer.removeClass('d-none');
            $productProcessPostprintActionContractorContainer.find('input, select').prop('disabled', false);

            $productProcessPostprintDetailContainer.addClass('d-none');
            $productProcessPostprintDetailContainer.find('input, select').prop('disabled', true);
        }
    });

    var $productProcessLaserPrintType = $('#js-process-product-laser-print-action-create-modal input[type=radio][name=type]');
    var $productProcessLaserPrintContractorContainer = $('#js-product-process-laser-print-contractor-container');
    var $productProcessLaserPrintDetailContainer = $('#js-product-process-laser-print-detail-container');
    $productProcessLaserPrintType.on('change', function(){
        if (this.value == '<?= PRODUCT_PROCESSES_TYPE_INDEPENDENTLY ?>') {
            $productProcessLaserPrintContractorContainer.addClass('d-none');
            $productProcessLaserPrintContractorContainer.find('input, select').prop('disabled', true);
            $productProcessLaserPrintDetailContainer.removeClass('d-none');
            $productProcessLaserPrintDetailContainer.find('input, select').prop('disabled', false);
        } else if (this.value == '<?= PRODUCT_PROCESSES_TYPE_OUTSOURCING ?>') {
            $productProcessLaserPrintContractorContainer.removeClass('d-none');
            $productProcessLaserPrintContractorContainer.find('input, select').prop('disabled', false);
            $productProcessLaserPrintDetailContainer.addClass('d-none');
            $productProcessLaserPrintDetailContainer.find('input, select').prop('disabled', true);
        }
    });

    changeStatus();
    $('#status').on('change', function (){
        changeStatus();
    });
    function changeStatus() {
        var $status = $('#status');
        var $dateCompletedContainer = $('#js-order-product-date-completed-container');
        var $statusMessageContainer = $('#js-order-product-status-message-container');
        if ($status.val() == '<?= ORDER_PRODUCTS_STATUS_IN_PROGRESS ?>') {
            $dateCompletedContainer.addClass('d-none');
            $dateCompletedContainer.find('input').prop('disabled', true);
            $statusMessageContainer.addClass('d-none');
            $statusMessageContainer.find('textarea').prop('disabled', true);
        } else if ($status.val() == '<?= ORDER_PRODUCTS_STATUS_COMPLETED ?>') {
            $dateCompletedContainer.removeClass('d-none');
            $dateCompletedContainer.find('input').prop('disabled', false);
            $statusMessageContainer.addClass('d-none');
            $statusMessageContainer.find('textarea').prop('disabled', true);
        } else if ($status.val() == '<?= ORDER_PRODUCTS_STATUS_PROBLEM ?>') {
            $dateCompletedContainer.addClass('d-none');
            $dateCompletedContainer.find('input').prop('disabled', true);
            $statusMessageContainer.removeClass('d-none');
            $statusMessageContainer.find('textarea').prop('disabled', false);
        }
    }
});
</script>
<?php $this->end(); ?>


<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-bags-shopping"></i> <?= __d('panel', 'Product #') ?>
        <span class="cursor-pointer copy shadow-hover" data-toggle="tooltip" data-trigger="hover" data-original-title="<?= __d('panel', 'Copy') ?>" data-clipboard-text="<?= h($orderProduct->unique_id) ?>">
            <?= h($orderProduct->unique_id) ?>
        </span>
        <small>
            <?php
            echo $this->Html->link(
                __d('panel', 'Order #{0}', h($orderProduct->order->unique_id)),
                ['controller' => 'Orders', 'action' => 'view', h($orderProduct->order->id)]
            );
            ?>
        </small>
    </h1>
</div>

<?php if (!$this->Orders->isEstimatedStatus($orderProduct->order)): ?>
    <?php if($this->OrderProducts->isInProgressStatus($orderProduct)): ?>
    <div class="alert alert-info fade show">
        <div class="d-flex align-items-center">
            <div class="alert-icon">
                <span class="icon-stack icon-stack-md">
                    <i class="base-2 icon-stack-3x color-info-400"></i>
                    <i class="base-10 text-white icon-stack-1x"></i>
                    <i class="ni md-profile color-info-800 icon-stack-2x"></i>
                </span>
            </div>
            <div class="flex-1">
                <span class="h2"><?= __d('panel', 'Order product in production') ?></span>
            </div>
            <?php if ($this->OrderProducts->isOutsourcing($orderProduct->type)): ?>
            <button class="btn btn-info btn-w-m fw-500 btn-sm" type="button" data-toggle="modal" data-target="#js-order-product-change-status-modal">
                <?= __d('panel', 'Change status') ?>
            </button>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if($this->OrderProducts->isCompletedStatus($orderProduct)): ?>
    <div class="alert alert-success fade show">
        <div class="d-flex align-items-center">
            <div class="alert-icon width-3">
                <span class="icon-stack icon-stack-sm">
                    <i class="base-2 icon-stack-3x color-success-600"></i>
                    <i class="base-10 text-white icon-stack-1x"></i>
                    <i class="ni md-profile color-success-800 icon-stack-2x"></i>
                </span>
            </div>
            <div class="flex-1">
                <span class="h2"><?= __d('panel', 'Order product completed') ?></span>
            </div>
            <?php if ($this->OrderProducts->isOutsourcing($orderProduct->type)): ?>
            <button class="btn btn-success btn-w-m fw-500 btn-sm" type="button" data-toggle="modal" data-target="#js-order-product-change-status-modal">
                <?= __d('panel', 'Change status') ?>
            </button>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($this->OrderProducts->isProblemStatus($orderProduct)): ?>
    <div class="alert bg-danger-600 fade show">
        <div class="d-flex align-items-center">
            <div class="alert-icon width-8">
                <span class="icon-stack icon-stack-xl">
                    <i class="base-2 icon-stack-3x color-danger-400"></i>
                    <i class="base-10 text-white icon-stack-1x"></i>
                    <i class="ni md-profile color-danger-800 icon-stack-2x"></i>
                </span>
            </div>
            <div class="flex-1 pl-1">
                <span class="h2"><?= __d('panel', 'There were problems with the order product') ?></span>
            </div>
            <?php if ($this->OrderProducts->isOutsourcing($orderProduct->type)): ?>
            <button class="btn btn-danger btn-w-m fw-500 btn-sm" type="button" data-toggle="modal" data-target="#js-order-product-change-status-modal">
                <?= __d('panel', 'Change status') ?>
            </button>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($this->OrderProducts->isOutsourcing($orderProduct->type)): ?>
    <div class="modal fade fw-400" id="js-order-product-change-status-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <?php
        echo $this->Form->create($orderProduct, [
            'url' => ['controller' => 'OrderProducts', 'action' => 'changeStatus', h($orderProduct->id)]
        ]);
        ?>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= __d('panel', 'Change status') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">                            
                    <?php if ($this->OrderProducts->isProblemStatus($orderProduct) && !empty($orderProduct->status_message)): ?>
                    <dl class="row mb-3 text-danger">
                        <dt class="col-md-4 col-lg-3"><?= __d('panel', 'Message') ?></dt>
                        <dd class="col-md-8 col-lg-9"><?= $orderProduct->status_message ?></dd>
                    </dl>
                    <hr/>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-12 mb-3">
                            <?php
                            echo $this->Form->control('status', [
                                'label' => __d('panel', 'Status') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'options' => $this->OrderProducts->listOfStatuses()
                            ]);
                            ?>
                            <div id="js-order-product-date-completed-container">
                                <?php
                                echo $this->Form->control('date_completed', [
                                    'label' => __d('panel', 'Date completed') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                    'escape' => false,
                                    'required' => true
                                ]);
                                ?>
                            </div>
                            <div id="js-order-product-status-message-container">
                                <?php
                                echo $this->Form->control('status_message', [
                                    'label' => __d('panel', 'Message'),
                                    'rows' => 3
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
<?php endif; ?>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= h($orderProduct->title) ?></h2>
                <?php if ($this->Orders->isNotCompletedStatus($orderProduct->order)): ?>
                <div class="panel-toolbar ml-auto mr-3">
                    <button type="button" class="btn btn-xs btn-warning mr-2" data-toggle="modal" data-target="#js-order-product-edit-modal">
                        <i class="fal fa-pencil mr-1"></i>
                        <?= __d('panel', 'Detail') ?>
                    </button>
                    <div class="modal fade" id="js-order-product-edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <?= $this->Form->create($orderProduct, ['url' => ['action' => 'edit', h($orderProduct->id)]]) ?>
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><?= __d('panel', 'Order product Details') ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <?php
                                            echo $this->Form->control('product_type_id', [
                                                'empty' => __d('panel', 'Select product type'),
                                                'label' => __d('panel', 'Product type') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                'escape' => false,
                                                'id' => 'js-order-product-product-type',
                                                'required' => true
                                            ]);
                                            echo $this->Form->control('quantity', [
                                                'label' => __d('panel', 'Quantity') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                'escape' => false,
                                                'required' => true
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
                    <?php
                    echo $this->Form->postLink(
                        $this->Html->tag('i', '', ['class' => 'fal fa-trash mr-1']) . __d('panel', 'Delete'),
                        $this->Url->build(['controller' => 'OrderProducts', 'action' => 'delete', h($orderProduct->id)]),
                        [
                            'class' => 'btn btn-xs btn-danger mr-1',
                            'data-title' => __d('panel', 'Are you sure you want to delete the order product?'),
                            'data-message' => __d('panel', 'Deletion eliminates the possibility of data recovery.')
                        ]
                    );
                    ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="row">
                        <div class="col-md-8">
                            <dl class="row fs-xl">
                                <dt class="col-md-3 col-lg-2"><?= __d('panel', 'Product type') ?></dt>
                                <dd class="col-md-9 col-lg-10">
                                    <?php
                                    echo $this->Html->link(
                                        h($orderProduct->product_type->title),
                                        ['controller' => 'ProductTypes', 'action' => 'view', h($orderProduct->product_type->id)]
                                    );
                                    ?>
                                </dd>
                                <dt class="col-md-3 col-lg-2"><?= __d('panel', 'Type') ?></dt>
                                <dd class="col-md-9 col-lg-10"><?= $this->OrderProducts->typeIcon(h($orderProduct->type)) ?></dd>

                                <dt class="col-md-3 col-lg-2"><?= __d('panel', 'Quantity') ?></dt>
                                <dd class="col-md-9 col-lg-10"><?= h($orderProduct->quantity) ?></dd>

                                <?php if (!empty($orderProduct->description)): ?>
                                <dt class="col-md-3 col-lg-2 mb-md-0"><?= __d('panel', 'Description') ?></dt>
                                <dd class="col-md-9 col-lg-10 mb-0"><?= h($orderProduct->description) ?></dd>
                                <?php endif; ?>
                            </dl>
                        </div>
                        <div class="col-md-4">
                            <?php if ($this->OrderProducts->isOutsourcing($orderProduct->type)): ?>
                            <div class="card shadow-none">
                                <div class="card-header bg-warning-50 py-2 d-flex align-items-center flex-wrap">
                                    <div class="card-title"><?= __d('panel', 'Contractor') ?></div>
                                    <button type="button" class="btn btn-xs btn-success ml-auto" data-toggle="modal" data-target="#js-order-product-contractor-modal">
                                        <?= __d('panel', 'Specify contractor') ?>
                                    </button>
                                    <div class="modal fade" id="js-order-product-contractor-modal" tabindex="-1" role="dialog" aria-hidden="true">
                                        <?= $this->Form->create($orderProduct, ['url' => ['action' => 'specifyContractor', h($orderProduct->id)]]) ?>
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?= __d('panel', 'Specify contractor') ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12 mb-3">
                                                            <?php
                                                            echo $this->Form->control('contractor_id', [
                                                                'label' => __d('panel', 'Contractor') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                'escape' => false,
                                                                'required' => true,
                                                                'empty' => __d('panel', 'Select contractor'),
                                                                'id' => 'js-order-product-contractor-id',
                                                                'class' => 'select2',
                                                                'options' => $contractors,
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
                                <div class="card-body">
                                    <dl class="row fs-lg mb-0">
                                        <dt class="col-md-5"><?= __d('panel', 'Title') ?></dt>
                                        <dd class="col-md-7">
                                            <?php
                                            echo $this->Html->link(h($orderProduct->contractor->title),
                                                ['controller' => 'Contractors', 'action' => 'view', h($orderProduct->contractor->id)]
                                            );
                                            ?>
                                        </dd>
                                        <dt class="col-md-5"><?= __d('panel', 'Full name') ?></dt>
                                        <dd class="col-md-7"><?= h($orderProduct->contractor_full_name) ?></dd>
                                        <dt class="col-md-5"><?= __d('panel', 'Phone number') ?></dt>
                                        <dd class="col-md-7">
                                            <?php
                                            echo $this->Html->link(
                                                $orderProduct->contractor_telephone,
                                                'tel:' . $orderProduct->contractor_telephone
                                            );
                                            ?>
                                        </dd>
                                        <?php
                                        if (
                                            $orderProduct->contractor_telephone == $orderProduct->contractor->representative->phone_number->full_number &&
                                            $this->PhoneNumbers->isTelegram($orderProduct->contractor->representative->phone_number->is_telegram)
                                        ):
                                        ?>
                                        <dt class="col-md-5"><?= __d('panel', 'Telegram') ?></dt>
                                        <dd class="col-md-7">
                                            <?php
                                            echo $this->Html->link(
                                                $this->Html->tag('i', '', ['class' => 'fab fa-telegram']),
                                                'https://t.me/' . $orderProduct->contractor_telephone,
                                                ['target' => '_blank', 'escape' => false, 'class' => 'fs-xxl']
                                            );
                                            ?>
                                        </dd>
                                        <?php endif; ?>
                                    </dl>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <div class="h4"><?= __d('panel', 'Product file locations') ?></div>
                        <span class="h2 cursor-pointer copy shadow-hover" data-toggle="tooltip" data-trigger="hover" data-original-title="<?= __d('panel', 'Copy') ?>" data-clipboard-text="\\192.168.1.10\Storage\<?= $orderProduct->order->unique_id ?>\<?= $orderProduct->unique_id ?>">
                            \\192.168.1.10\Storage\<?= $orderProduct->order->unique_id ?>\<?= $orderProduct->unique_id ?>
                        </span>
                    </div>

                    <?php if (!empty($orderProduct->cost_price)): ?>
                    <hr class="my-3" />
                    <div class="row">
                        <?php if ($this->OrderProducts->isOutsourcing($orderProduct->type)): ?>
                        <div class="col-lg-6 mb-3 mb-lg-0">
                            <div class="p-3 bg-warning-400 rounded overflow-hidden position-relative text-white">
                                <div>
                                    <h3 class="display-4 d-block l-h-n m-0 fw-500 cursor-pointer" data-toggle="modal" data-target="#js-order-product-cost-price-modal">
                                        <?= $this->Number->currency($orderProduct->cost_price, 'UZS') ?>
                                        <small class="m-0 l-h-n"><?= __d('panel', 'Cost price') ?></small>
                                    </h3>
                                </div>
                                <i class="fal fa-gem position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4" style="font-size: 6rem;"></i>
                            </div>
                            <div class="modal fade" id="js-order-product-cost-price-modal" tabindex="-1" role="dialog" aria-hidden="true">
                                <?= $this->Form->create($orderProduct, ['url' => ['action' => 'edit', h($orderProduct->id)]]) ?>
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><?= __d('panel', 'Edit cost price') ?></h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12 mb-3">
                                                    <?php
                                                    echo $this->Form->control('cost_price', [
                                                        'label' => __d('panel', 'Cost price') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
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
                        </div>
                        <?php else: ?>
                        <div class="col-lg-6 mb-3 mb-lg-0">
                            <div class="p-3 bg-warning-400 rounded overflow-hidden position-relative text-white">
                                <div>
                                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                                        <?= $this->Number->currency($orderProduct->cost_price, 'UZS') ?>
                                        <small class="m-0 l-h-n"><?= __d('panel', 'Cost price') ?></small>
                                    </h3>
                                </div>
                                <i class="fal fa-gem position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4" style="font-size: 6rem;"></i>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if ($this->Orders->specifiedClient($orderProduct->order)): ?>
                        <div class="col-lg-6 mb-3 mb-lg-0">

                            <?php if ($this->Clients->isInternal($orderProduct->order->client->type)): ?>
                            <div class="p-3 bg-success-200 rounded overflow-hidden position-relative text-white">
                                <div>
                                    <h3 class="display-4 d-block l-h-n m-0 fw-500 cursor-pointer" data-toggle="modal" data-target="#js-order-product-competitve-price-modal">
                                        <?= $this->OrderProducts->savedPriceView($orderProduct) ?>
                                        <small class="m-0 l-h-n"><?= __d('panel', 'Saving') ?></small>
                                    </h3>
                                </div>
                                <i class="fal fa-lightbulb position-absolute pos-right pos-bottom opacity-15 mb-n5 mr-n6" style="font-size: 8rem;"></i>
                            </div>
                            <div class="modal fade" id="js-order-product-competitve-price-modal" tabindex="-1" role="dialog" aria-hidden="true">
                                <?= $this->Form->create($orderProduct, ['url' => ['action' => 'edit', h($orderProduct->id)]]) ?>
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><?= __d('panel', 'Savings calculation') ?></h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12 mb-3">
                                                    <div class="alert alert-info">
                                                        <div class="mb-3"><?= __d('panel', 'You must specify a competitive price for 1 copy of the product.') ?></div>
                                                        <dl class="row mb-0">
                                                            <dt class="col-md-3"><?= __d('panel', 'Cost price') ?></dt>
                                                            <dd class="col-md-9">
                                                                <?php
                                                                echo $this->Number->currency(
                                                                    $this->OrderProducts->costPriceOfOneCopy($orderProduct),
                                                                    'UZS'
                                                                );
                                                                ?>
                                                            </dd>
                                                            <dt class="col-md-3"><?= __d('panel', 'Quantity') ?></dt>
                                                            <dd class="col-md-9 mb-0"><?= h($orderProduct->quantity) ?></dd>
                                                        </dl>
                                                    </div>
                                                    <?php
                                                    echo $this->Form->control('competitive_price', [
                                                        'label' => __d('panel', 'Competitive price') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
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

                            <?php if ($this->Clients->isExternal($orderProduct->order->client->type)): ?>
                            <div class="p-3 bg-success-200 rounded overflow-hidden position-relative text-white">
                                <div class="">
                                    <h3 class="display-4 d-block l-h-n m-0 fw-500 cursor-pointer" data-toggle="modal" data-target="#js-order-product-profit-price-modal">
                                        <?= $this->OrderProducts->profitPriceView($orderProduct) ?>
                                        <small class="m-0 l-h-n"><?= __d('panel', 'Profit') ?></small>
                                    </h3>
                                </div>
                                <i class="fal fa-lightbulb position-absolute pos-right pos-bottom opacity-15 mb-n5 mr-n6" style="font-size: 8rem;"></i>
                            </div>
                            <div class="modal fade" id="js-order-product-profit-price-modal" tabindex="-1" role="dialog" aria-hidden="true">
                                <?= $this->Form->create($orderProduct, ['url' => ['action' => 'edit', h($orderProduct->id)]]) ?>
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><?= __d('panel', 'Profit calculation') ?></h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12 mb-3">
                                                    <div class="alert alert-info">
                                                        <div class="mb-3"><?= __d('panel', 'You must specify a price with a profit for 1 copy of the product..') ?></div>
                                                        <dl class="row mb-0">
                                                            <dt class="col-md-3"><?= __d('panel', 'Cost price') ?></dt>
                                                            <dd class="col-md-9">
                                                                <?php
                                                                echo $this->Number->currency(
                                                                    $this->OrderProducts->costPriceOfOneCopy($orderProduct),
                                                                    'UZS'
                                                                );
                                                                ?>
                                                            </dd>
                                                            <dt class="col-md-3"><?= __d('panel', 'Quantity') ?></dt>
                                                            <dd class="col-md-9 mb-0"><?= h($orderProduct->quantity) ?></dd>
                                                        </dl>
                                                    </div>
                                                    <?php
                                                    echo $this->Form->control('profit_price', [
                                                        'label' => __d('panel', 'Profit price') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
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
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <?php if ($this->OrderProducts->isIndependently($orderProduct->type)): ?>
                    <hr />
                    <div class="card m-auto border shadow-none">
                        <div class="card-header py-2 d-flex align-items-center flex-wrap">
                            <div class="card-title fw-700"><?= __d('panel', 'Processes') ?></div>
                            <?php if ($this->Orders->isNotCompletedStatus($orderProduct->order)): ?>
                            <div class="btn-group ml-auto">
                                <button type="button" class="btn btn-xs btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?= __d('panel', 'Create proccess') ?>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#js-process-product-preprint-action-create-modal">
                                        <?= __d('panel', 'Preprint') ?>
                                    </button>
                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#js-process-product-postprint-action-create-modal">
                                        <?= __d('panel', 'Postprint') ?>
                                    </button>
                                    <h2 class="dropdown-header"><?= __d('panel', 'Print') ?></h2>
                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#js-process-product-laser-print-action-create-modal">
                                        <?= __d('panel', 'Laser printing') ?>
                                    </button>
                                </div>

                                <div class="modal fade" id="js-process-product-preprint-action-create-modal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <?= $this->Form->create($productProcess, ['id' => 'product-process-preprint-form', 'url' => ['controller' => 'ProductProcesses', 'action' => 'add']]) ?>
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?= __d('panel', 'Create preprint process') ?></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <?php
                                                        echo $this->Form->control('order_product_id', [
                                                            'id' => 'preprint-order-product-id',
                                                            'type' => 'hidden',
                                                            'value' => h($orderProduct->id)
                                                        ]);
                                                        echo $this->Form->control('group_type', [
                                                            'id' => 'preprint-group-type',
                                                            'type' => 'hidden',
                                                            'value' => ACTIONS_GROUP_TYPE_PREPRESS
                                                        ]);
                                                        echo $this->Form->control('type', [
                                                            'id' => 'preprint-type',
                                                            'label' => __d('panel', 'Manufacturer') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                            'type' => 'radio',
                                                            'escape' => false,
                                                            'options' => $this->ProductProcesses->typeList(),
                                                            'default' => PRODUCT_PROCESSES_TYPE_INDEPENDENTLY
                                                        ]);
                                                        ?>

                                                        <div id="js-product-process-preprint-action-contractor-container" class="d-none">
                                                            <div class="row mb-3">
                                                                <div class="col-md-8 mb-3 mb-md-0">
                                                                    <?php
                                                                    echo $this->Form->control('contractor_id', [
                                                                        'empty' => __d('panel', 'Select contractor'),
                                                                        'label' => __d('panel', 'Contractors') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                        'id' => 'js-product-process-preprint-action-contractor-id',
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
                                                                        'id' => 'js-product-process-preprint-action-cost-price',
                                                                        'disabled' => true,
                                                                        'required' => true
                                                                    ]);
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr/>

                                                        <div id="js-product-process-preprint-detail-container">
                                                            <?php
                                                            echo $this->Form->control('process_action.action_price_id', [
                                                                'label' => __d('panel', 'Process') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                'empty' => __d('panel', 'Select process'),
                                                                'escape' => false,
                                                                'id' => 'js-product-process-preprint-action-price-id',
                                                                'class' => 'select2',
                                                                'options' => $prePrintActions
                                                            ]);
                                                            echo $this->Form->control('process_action.quantity', [
                                                                'id' => 'preprint-process-action-quantity',
                                                                'label' => __d('panel', 'Quantity') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                'escape' => false,
                                                                'required' => true
                                                            ]);
                                                            ?>

                                                            <hr/>
                                                        </div>

                                                        <?php
                                                        echo $this->Form->control('title', [
                                                            'id' => 'preprint-title',
                                                            'label' => __d('panel', 'Title') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                            'escape' => false,
                                                            'required' => true
                                                        ]);
                                                        echo $this->Form->control('description', [
                                                            'id' => 'preprint-description',
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

                                <div class="modal fade" id="js-process-product-postprint-action-create-modal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <?= $this->Form->create($productProcess, ['id' => 'product-process-postprint-form', 'url' => ['controller' => 'ProductProcesses', 'action' => 'add']]) ?>
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?= __d('panel', 'Create postprint process') ?></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <?php
                                                        echo $this->Form->control('order_product_id', [
                                                            'id' => 'postprint-order-product-id',
                                                            'type' => 'hidden',
                                                            'value' => h($orderProduct->id)
                                                        ]);
                                                        echo $this->Form->control('group_type', [
                                                            'id' => 'postprint-group-type',
                                                            'type' => 'hidden',
                                                            'value' => ACTIONS_GROUP_TYPE_POSTPRESS
                                                        ]);
                                                        echo $this->Form->control('type', [
                                                            'id' => 'postprint-type',
                                                            'label' => __d('panel', 'Manufacturer') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                            'type' => 'radio',
                                                            'escape' => false,
                                                            'options' => $this->ProductProcesses->typeList(),
                                                            'default' => PRODUCT_PROCESSES_TYPE_INDEPENDENTLY
                                                        ]);
                                                        ?>

                                                        <div id="js-product-process-postprint-action-contractor-container" class="d-none">
                                                            <div class="row mb-3">
                                                                <div class="col-md-8 mb-3 mb-md-0">
                                                                    <?php
                                                                    echo $this->Form->control('contractor_id', [
                                                                        'empty' => __d('panel', 'Select contractor'),
                                                                        'label' => __d('panel', 'Contractors') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                        'id' => 'js-product-process-postprint-action-contractor-id',
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
                                                                        'id' => 'js-product-process-postprint-action-cost-price',
                                                                        'disabled' => true,
                                                                        'required' => true
                                                                    ]);
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr/>

                                                        <div id="js-product-process-postprint-detail-container">
                                                            <?php
                                                            echo $this->Form->control('process_action.action_price_id', [
                                                                'label' => __d('panel', 'Process') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                'empty' => __d('panel', 'Select process'),
                                                                'escape' => false,
                                                                'id' => 'js-product-process-postprint-action-price-id',
                                                                'class' => 'select2',
                                                                'options' => $postPrintActions
                                                            ]);
                                                            echo $this->Form->control('process_action.quantity', [
                                                                'id' => 'postprint-process-action-auantity',
                                                                'label' => __d('panel', 'Quantity') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                'escape' => false,
                                                                'required' => true
                                                            ]);
                                                            ?>

                                                            <hr/>
                                                        </div>

                                                        <?php
                                                        echo $this->Form->control('title', [
                                                            'id' => 'postprint-title',
                                                            'label' => __d('panel', 'Title') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                            'escape' => false,
                                                            'required' => true
                                                        ]);
                                                        echo $this->Form->control('description', [
                                                            'id' => 'postprint-description',
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

                                <div class="modal fade" id="js-process-product-laser-print-action-create-modal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <?= $this->Form->create($productProcess, ['id' => 'product-process-laser-print-form', 'url' => ['controller' => 'ProductProcesses', 'action' => 'add']]) ?>
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?= __d('panel', 'Create laser print process') ?></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <?php
                                                        echo $this->Form->control('order_product_id', [
                                                            'id' => 'laser-print-order-product-id',
                                                            'type' => 'hidden',
                                                            'value' => h($orderProduct->id)
                                                        ]);
                                                        echo $this->Form->control('group_type', [
                                                            'id' => 'laser-print-group-type',
                                                            'type' => 'hidden',
                                                            'value' => PRODUCT_PROCESSES_GROUP_TYPE_PRESS
                                                        ]);
                                                        echo $this->Form->control('type', [
                                                            'id' => 'laser-print-type',
                                                            'label' => __d('panel', 'Manufacturer') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                            'type' => 'radio',
                                                            'escape' => false,
                                                            'options' => $this->ProductProcesses->typeList(),
                                                            'default' => ORDER_PRODUCTS_TYPE_INDEPENDENTLY
                                                        ]);
                                                        ?>

                                                        <div id="js-product-process-laser-print-contractor-container" class="d-none">
                                                            <div class="row mb-3">
                                                                <div class="col-md-8 mb-3 mb-md-0">
                                                                    <?php
                                                                    echo $this->Form->control('contractor_id', [
                                                                        'empty' => __d('panel', 'Select contractor'),
                                                                        'label' => __d('panel', 'Contractors') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                        'id' => 'js-product-process-laser-print-contractor-id',
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
                                                                        'id' => 'js-product-process-laser-print-cost-price',
                                                                        'disabled' => true,
                                                                        'required' => true
                                                                    ]);
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr />

                                                        <div id="js-product-process-laser-print-detail-container">
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <?php
                                                                    echo $this->Form->control('process_laser_machine.number_of_copies', [
                                                                        'id' => 'js-product-process-process-laser-machine-number-of-copies',
                                                                        'label' => __d('panel', 'Number of copies') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                        'escape' => false
                                                                    ]);
                                                                    ?>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <?php
                                                                    echo $this->Form->control('process_laser_machine.number_of_pages', [
                                                                        'id' => 'js-product-process-process-laser-machine-number-of-pages',
                                                                        'label' => __d('panel', 'Number of pages') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                        'escape' => false
                                                                    ]);
                                                                    ?>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <?php
                                                                    echo $this->Form->control('process_laser_machine.width', [
                                                                        'id' => 'js-product-process-process-laser-machine-width',
                                                                        'label' => __d('panel', 'Width, mm') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                        'escape' => false
                                                                    ]);
                                                                    ?>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <?php
                                                                    echo $this->Form->control('process_laser_machine.height', [
                                                                        'id' => 'js-product-process-process-laser-machine-height',
                                                                        'label' => __d('panel', 'Height, mm') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                        'escape' => false
                                                                    ]);
                                                                    ?>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <?php
                                                                    echo $this->Form->control('process_laser_machine.print_type', [
                                                                        'id' => 'js-product-process-process-laser-machine-print-type',
                                                                        'label' => __d('panel', 'Print type') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                        'escape' => false,
                                                                        'type' => 'select',
                                                                        'options' => $this->ProcessLaserMachines->listOfPrintTypes()
                                                                    ]);
                                                                    ?>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <?php
                                                                    echo $this->Form->control('process_laser_machine.laser_machine_rate_id', [
                                                                        'label' => __d('panel', 'Printer') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                        'empty' => __d('panel', 'Select printer'),
                                                                        'escape' => false,
                                                                        'id' => 'js-product-process-process-laser-machine-laser-machine-rate-id',
                                                                        'options' => $laserMachines
                                                                    ]);
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <div class="panel-tag mt-2 mb-2 p-2">
                                                                <?= __d('panel', 'CMYK fill percentage, %') ?>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-3 mb-3">
                                                                    <?php
                                                                    echo $this->Form->control('process_laser_machine.pouring_c', [
                                                                        'id' => 'js-product-process-process-laser-machine-pouring_c',
                                                                        'label' => __d('panel', 'Cyan') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                        'escape' => false
                                                                    ]);
                                                                    ?>
                                                                </div>
                                                                <div class="col-md-3 mb-3">
                                                                    <?php
                                                                    echo $this->Form->control('process_laser_machine.pouring_m', [
                                                                        'id' => 'js-product-process-process-laser-machine-pouring_m',
                                                                        'label' => __d('panel', 'Magenta') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                        'escape' => false
                                                                    ]);
                                                                    ?>
                                                                </div>
                                                                <div class="col-md-3 mb-3">
                                                                    <?php
                                                                    echo $this->Form->control('process_laser_machine.pouring_y', [
                                                                        'id' => 'js-product-process-process-laser-machine-pouring_y',
                                                                        'label' => __d('panel', 'Yellow') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                        'escape' => false
                                                                    ]);
                                                                    ?>
                                                                </div>
                                                                <div class="col-md-3 mb-3">
                                                                    <?php
                                                                    echo $this->Form->control('process_laser_machine.pouring_k', [
                                                                        'id' => 'js-product-process-process-laser-machine-pouring_k',
                                                                        'label' => __d('panel', 'Black') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                        'escape' => false
                                                                    ]);
                                                                    ?>
                                                                </div>
                                                            </div>

                                                            <hr />
                                                        </div>

                                                        <?php
                                                        echo $this->Form->control('title', [
                                                            'id' => 'laser-print-title',
                                                            'label' => __d('panel', 'Title') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                            'escape' => false,
                                                            'required' => true
                                                        ]);
                                                        echo $this->Form->control('description', [
                                                            'id' => 'laser-print-description',
                                                            'rows' => 2,
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
                            </div>
                            <?php endif; ?>

                        </div>
                        <div class="card-body">
                            <?php
                            if (!empty($orderProduct->product_processes)) {
                                $productProcesses = $this->ProductProcesses->sortProcessesByGroup($orderProduct->product_processes);
                                if (!empty($productProcesses['preprint'])) {
                                    echo $this->Html->tag('h3', __d('panel', 'Preprint'), ['class' => 'mb-3 h4 fw-700 bg-warning-50 px-2 py-2']);
                                    foreach($productProcesses['preprint'] as $productPrePrintProcess) {
                                        echo $this->element('ProductProcesses/process_table', [
                                            'consumables' => $consumables,
                                            'papers' => $papers,
                                            'processConsumable' => $processConsumable,
                                            'processPaper' => $processPaper,
                                            'productProcess' => $productPrePrintProcess,
                                        ]);
                                    }
                                    echo '<hr/>';
                                }
    
                                if (!empty($productProcesses['print'])) {
                                    echo $this->Html->tag('h3', __d('panel', 'Print'), ['class' => 'mb-3 h4 fw-700 bg-warning-50 px-2 py-2']);
                                    foreach($productProcesses['print'] as $productPrintProcess) {
                                        echo $this->element('ProductProcesses/process_table', [
                                            'consumables' => $consumables,
                                            'papers' => $papers,
                                            'processConsumable' => $processConsumable,
                                            'processPaper' => $processPaper,
                                            'productProcess' => $productPrintProcess,
                                        ]);
                                    }
                                    echo '<hr/>';
                                }
    
                                if (!empty($productProcesses['postprint'])) {
                                    echo $this->Html->tag('h3', __d('panel', 'Postprint'), ['class' => 'mb-3 h4 fw-700 bg-warning-50 px-2 py-2']);
                                    foreach($productProcesses['postprint'] as $productPostPrintProcess) {
                                        echo $this->element('ProductProcesses/process_table', [
                                            'consumables' => $consumables,
                                            'papers' => $papers,
                                            'processConsumable' => $processConsumable,
                                            'processPaper' => $processPaper,
                                            'productProcess' => $productPostPrintProcess,
                                        ]);
                                    }
                                }
                            } else {
                                echo $this->Html->tag('div', __d('panel', 'Production processes of the product are not specified'), ['class' => 'text-center text-info my-1']);
                            }
                            
                            ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>