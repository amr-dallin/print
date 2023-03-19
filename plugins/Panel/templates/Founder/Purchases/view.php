<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $purchase
 */
$this->assign('title', __d('panel', 'Purchase #{0}', $purchase->id));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Storage')],
    ['title' => __d('panel', 'Purchases'), 'url' => ['action' => 'index']],
    ['title' => __d('panel', 'Purchase #{0}', $purchase->id)]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['storage']['purchases'] = true;
echo $this->element('press_navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css([
    'formplugins/select2/select2.bundle'
], ['block' => true]);

echo $this->Html->script(
    ['formplugins/select2/select2.bundle'],
    ['block' => true]
);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function() {
    $('.select2').select2();

    $('#js-foreign-key-paper-id').select2({
        dropdownParent: $('#js-purchase-entity-paper-create-modal')
    });
    $('#js-foreign-key-consumable-id').select2({
        dropdownParent: $('#js-purchase-entity-consumable-create-modal')
    });
});
</script>
<?php $this->end(); ?>

<?php if (!$this->Purchases->isApproved($purchase)): ?>
<div class="alert bg-fusion-400 border-0 fade show">
    <div class="d-flex align-items-center">
        <div class="alert-icon">
            <i class="fal fa-shield-check text-warning"></i>
        </div>
        <div class="flex-1">
            <span class="h5"><?= __d('panel', 'Purchasing approval') ?></span>
            <br><?= __d('panel', 'At the moment, the purchase is not approved and does not appear in the system\'s calculations') ?>
        </div>
        <button type="button" class="btn btn-warning btn-w-m fw-500 btn-sm" data-toggle="modal" data-target="#js-purchase_approve_modal"><?= __d('panel', 'Approve') ?></button>
    </div>
</div>
<div class="modal fade" id="js-purchase_approve_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <?= $this->Form->create($purchase, ['url' => ['action' => 'approve', h($purchase->id)]]) ?>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?= __d('panel', 'Purchasing approval') ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <?php
                        echo $this->Form->control('date_purchased', [
                            'label' => __d('panel', 'Date purchased') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
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
<?php endif; ?>

<?php if ($this->Purchases->isApproved($purchase)): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong><?= __d('panel', 'Well Done!') ?></strong> <?= __d('panel', 'Purchase approved') ?>
</div>
<?php endif; ?>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-container show">
                <div class="panel-content">
                    <h1 class="mb-3"><?= __d('panel', 'Purchase #{0}', $purchase->id) ?></h1>
                    <dl class="row fs-xl">
                        <dt class="col-md-3 col-lg-2"><?= __d('panel', 'Supplier') ?></dt>
                        <dd class="col-md-9 col-lg-10">
                            <?php
                            echo $this->Html->link($purchase->supplier->title, [
                                'controller' => 'Suppliers',
                                'action' => 'view',
                                $purchase->supplier_id
                            ]);
                            ?>
                        </dd>
                        <?php if (!empty($purchase->description)): ?>
                        <dt class="col-md-3 col-lg-2"><?= __d('panel', 'Description') ?></dt>
                        <dd class="col-md-9 col-lg-10"><?= h($purchase->description) ?></dd>
                        <?php endif; ?>

                        <?php if ($this->Purchases->isApproved($purchase)): ?>

                        <?php if (!empty($purchase->date_purchased)): ?>
                        <dt class="col-md-3 col-lg-2"><?= __d('panel', 'Date purchased') ?></dt>
                        <dd class="col-md-9 col-lg-10"><?= $purchase->date_purchased->format('d.m.Y') ?></dd>
                        <?php endif; ?>

                        <dt class="col-md-3 col-lg-2"><?= __d('panel', 'Total') ?></dt>
                        <dd class="col-md-9 col-lg-10">
                            <?= $this->Number->currency($this->Purchases->total($purchase->purchase_entities), 'UZS') ?>
                        </dd>
                        <?php endif; ?>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-2" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Entities') ?></h2>
                <div class="panel-toolbar ml-auto mr-3">
                    <button type="button" class="btn btn-xs btn-success mr-2" data-toggle="modal" data-target="#js-purchase-entity-paper-create-modal"><?= __d('panel', 'Add paper') ?></button>
                    <div class="modal fade" id="js-purchase-entity-paper-create-modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <?= $this->Form->create($purchaseEntity, ['url' => ['controller' => 'PurchaseEntities', 'action' => 'add']]) ?>
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><?= __d('panel', 'Add entity') ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <?php
                                            echo $this->Form->control('purchase_id', [
                                                'type' => 'hidden',
                                                'value' => $purchase->id
                                            ]);
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
                                            <?= $this->Form->control('quantity') ?>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <?= $this->Form->control('amount') ?>
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

                    <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#js-purchase-entity-consumable-create-modal"><?= __d('panel', 'Add consumable') ?></button>
                    <div class="modal fade" id="js-purchase-entity-consumable-create-modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <?= $this->Form->create($purchaseEntity, ['url' => ['controller' => 'PurchaseEntities', 'action' => 'add']]) ?>
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><?= __d('panel', 'Add entity') ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <?php
                                            echo $this->Form->control('purchase_id', [
                                                'type' => 'hidden',
                                                'value' => $purchase->id
                                            ]);
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
                                            <?= $this->Form->control('quantity') ?>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <?= $this->Form->control('amount') ?>
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
                    <table class="table table-bordered table-hover table-striped w-100 datatable">
                        <thead>
                            <tr>
                                <th class="all"></th>
                                <th class="all text-center"><?= __d('panel', 'Type') ?></th>
                                <th class="all"><?= __d('panel', 'Title') ?></th>
                                <th class="min-desktop text-center"><?= __d('panel', 'Quantity') ?></th>
                                <th class="all text-right"><?= __d('panel', 'Amount') ?></th>
                                <th class="all text-right"><?= __d('panel', 'Total') ?></th>
                                <th class="all"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($purchase->purchase_entities as $purchaseEntity): ?>
                            <tr>
                                <td class="text-center">
                                    <?php
                                    echo $this->Form->postLink(
                                        $this->Html->tag('i', '', ['class' => 'fal fa-trash']),
                                        $this->Url->build(['controller' => 'PurchaseEntities', 'action' => 'delete', h($purchaseEntity->id)]),
                                        [
                                            'class' => 'color-danger-900',
                                            'data-title' => __d('panel', 'Are you sure you want to delete the expense?'),
                                            'data-message' => __d('panel', 'Deletion eliminates the possibility of data recovery.')
                                        ]
                                    );
                                    ?>
                                </td>
                                <td class="text-center"><?= $this->Materials->modelIcon($purchaseEntity) ?></div>
                                <td><?= h($purchaseEntity->title) ?></td>
                                <td class="text-center"><?= h($purchaseEntity->quantity) ?></td>
                                <td class="text-right"><?= $this->Number->currency($purchaseEntity->amount, 'UZS') ?></td>
                                <td class="text-right">
                                    <?= $this->Number->currency($this->PurchaseEntities->total($purchaseEntity), 'UZS') ?>
                                </td>
                                <td>
                                    <a href="#" class="d-block text-center" data-toggle="modal" data-target="#js-purchase_entity_edit_modal-<?= h($purchaseEntity->id) ?>">
                                        <i class="fal fa-pencil"></i>
                                    </a>
                                    <div class="modal fade" id="js-purchase_entity_edit_modal-<?= h($purchaseEntity->id) ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                        <?= $this->Form->create($purchaseEntity, ['url' => ['controller' => 'PurchaseEntities', 'action' => 'edit', h($purchaseEntity->id)]]) ?>
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?= __d('panel', 'Edit purchase entity') ?></h4>
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
                                                                    <dd class="col-md-10"><?= $this->Materials->modelIcon($purchaseEntity) ?></dd>
                                                                    <dt class="col-md-2"><?= __d('panel', 'Title') ?></dt>
                                                                    <dd class="col-md-10 mb-0"><?= h($purchaseEntity->title) ?></dd>
                                                                </dl>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <?= $this->Form->control('quantity') ?>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <?= $this->Form->control('amount') ?>
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
                </div>
            </div>
        </div>
    </div>
</div>