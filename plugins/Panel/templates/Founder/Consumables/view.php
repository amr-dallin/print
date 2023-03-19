<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $consumable
 */
$this->assign('title', h($consumable->title));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Directory')],
    ['title' => __d('panel', 'Consumables'), 'url' => ['action' => 'index']],
    ['title' => h($consumable->title)]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['directory']['consumables']['assortment'] = true;
echo $this->element('press_navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css([
    'datagrid/datatables/datatables.bundle'
], ['block' => true]);

echo $this->Html->script([
    'datagrid/datatables/datatables.bundle'
], ['block' => true]);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function() {
    $('#js-table-purchases').dataTable({
        pageLength: 25,
        responsive: {
            details: {
                type: 'column', target: 'tr'
            }
        },
        order: [[1, 'asc']]
    });

    $('#js-table-expenses').dataTable({
        pageLength: 25,
        responsive: {
            details: {
                type: 'column', target: 'tr'
            }
        },
        order: [[0, 'asc']]
    });
});
</script>
<?php $this->end(); ?>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Description') ?></h2>
                <div class="panel-toolbar ml-auto mr-3">
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('i', '', ['class' => 'fal fa-pencil mr-1']) . __d('panel', 'Edit'),
                        ['action' => 'edit', h($consumable->id)],
                        ['class' => 'btn btn-xs btn-warning', 'escape' => false]
                    );
                    ?>
                    <?php if ($this->Consumables->usedInCalculation($consumable->type)): ?>
                    <button type="button" class="btn btn-xs btn-success ml-2 mr-2" data-toggle="modal" data-target="#js-consumable-price-create-modal"><?= __d('panel', 'Set price') ?></button>
                    <div class="modal fade" id="js-consumable-price-create-modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <?= $this->Form->create($consumablePrice, ['url' => ['controller' => 'ConsumablePrices', 'action' => 'add']]) ?>
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><?= __d('panel', 'Set price') ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <?php
                                        echo $this->Form->control('consumable_id', [
                                            'type' => 'hidden',
                                            'value' => $consumable->id
                                        ]);
                                        ?>
                                        <div class="col-12 mb-3">
                                            <?php
                                            echo $this->Form->control('amount', [
                                                'label' => __d('panel', 'Amount') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                'escape' => false,
                                            ]);
                                            ?>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <?php
                                            echo $this->Form->control('date_commited', [
                                                'label' => __d('panel', 'Date commited') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                'escape' => false,
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
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <h1 class="mb-3"><?= h($consumable->title) ?></h1>
                    <dl class="row fs-xl">
                        <dt class="col-md-3 col-lg-2"><?= __d('panel', 'Category') ?></dt>
                        <dd class="col-md-9 col-lg-10">
                            <?php
                            echo $this->Html->link(
                                h($consumable->consumable_category->title),
                                ['controller' => 'ConsumableCategories', 'action' => 'view', h($consumable->consumable_category->id)]
                            );
                            ?>
                        </dd>
                        <dt class="col-md-3 col-lg-2"><?= __d('panel', 'Type') ?></dt>
                        <dd class="col-md-9 col-lg-10"><?= $this->Consumables->typeIcon($consumable->type) ?></dd>
                        
                        <?php if (!empty($consumable->description)): ?>
                        <dt class="col-md-3 col-lg-2"><?= __d('panel', 'Description') ?></dt>
                        <dd class="col-md-9 col-lg-10"><?= h($consumable->description) ?></dd>
                        <?php endif; ?>

                        <dt class="col-md-3 col-lg-2"><?= __d('panel', 'Unit') ?></dt>
                        <dd class="col-md-9 col-lg-10"><?= $this->Consumables->unit($consumable) ?></dd>

                        <?php if ($this->Consumables->usedInCalculation($consumable->type)): ?>
                        <dt class="col-md-3 col-lg-2"><?= __d('panel', 'Price') ?></dt>
                        <dd class="col-md-9 col-lg-10 mb-0 text-success"><?= $this->Consumables->currentPriceView($consumable->consumable_prices) ?></dd>
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
                <h2><?= __d('panel', 'Turnover') ?></h2>
                <div class="panel-toolbar ml-auto mr-3">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item ">
                            <a class="nav-link btn-xs active" data-toggle="tab" href="#js-pill-purchases-consumable">
                                <?= __d('panel', 'Purchases') ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-xs" data-toggle="tab" href="#js-pill-expenses-consumable">
                                <?= __d('panel', 'Expenses') ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="tab-content py-3">
                        <div class="tab-pane fade show active" id="js-pill-purchases-consumable" role="tabpanel">
                            <table class="table table-bordered table-hover table-striped w-100" id="js-table-purchases">
                                <thead>
                                    <tr>
                                        <th class="all"><?= __d('panel', 'Supplier') ?></th>
                                        <th class="all"><?= __d('panel', 'Date purchased') ?></th>
                                        <th class="all text-center"><?= __d('panel', 'Quantity') ?></th>
                                        <th class="all text-right"><?= __d('panel', 'Amount') ?></th>
                                        <th class="all text-right"><?= __d('panel', 'Total') ?></th>
                                        <th class="all text-right"><?= __d('panel', 'Unit price') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($consumable->purchase_entities as $purchaseEntity): ?>
                                    <tr>
                                        <td>
                                            <?php
                                            echo $this->Html->link(
                                                $purchaseEntity->purchase->supplier->title,
                                                ['controller' => 'Suppliers', 'action' => 'view', h($purchaseEntity->purchase->supplier->id)]
                                            );
                                            ?>
                                        </td>
                                        <td><?= $purchaseEntity->purchase->date_purchased->format('d.m.Y') ?></td>
                                        <td class="text-center"><?= h($purchaseEntity->quantity) ?></td>
                                        <td class="text-right"><?= $this->Number->currency($purchaseEntity->amount, 'UZS') ?></td>
                                        <td class="text-right"><?= $this->Number->currency($this->PurchaseEntities->total($purchaseEntity), 'UZS') ?></td>
                                        <td class="text-right fw-700 fs-lg">
                                            <?php
                                            if ($this->Consumables->usedInCalculation($consumable->type)) {
                                                echo $this->Number->currency(
                                                    $this->Consumables->unitPrice($consumable, $purchaseEntity),
                                                    'UZS'
                                                );
                                            } else {
                                                echo $this->Html->tag('span', __d('panel', 'Not used'), ['class' => 'text-warning']);
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="js-pill-expenses-consumable" role="tabpanel">
                            <table class="table table-bordered table-hover table-striped w-100" id="js-table-expenses">
                                <thead>
                                    <tr>
                                        <th class="all"><?= __d('panel', 'Date expensed') ?></th>
                                        <th class="all text-center"><?= __d('panel', 'Quantity') ?></th>
                                        <th class="all"><?= __d('panel', 'Unit') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($consumable->expenses as $expense): ?>
                                    <tr>
                                        <td><?= $expense->date_expensed->format('d.m.Y') ?></td>
                                        <td class="text-center"><?= $expense->quantity ?></td>
                                        <td><?= $this->Consumables->unit($consumable) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>