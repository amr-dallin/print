<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\Cake\Datasource\EntityInterface> $productTypes
 */
$this->assign('title', __d('panel', 'Product Types'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Directory')],
    ['title' => __d('panel', 'Product Types')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['directory']['product_types'] = true;
echo $this->element('press_navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css('datagrid/datatables/datatables.bundle', ['block' => true]);
echo $this->Html->script('datagrid/datatables/datatables.bundle', ['block' => true]);
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
            targets: [0, 4],
            orderable: false
        }],
        order: [[1, 'asc']]
    });
});
</script>
<?php $this->end(); ?>


<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-table"></i> <?= __d('panel', 'Product Types') ?>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <div class="panel-toolbar ml-auto mr-3">
                    <button type="button" class="btn btn-xs btn-success mr-2" data-toggle="modal" data-target="#js-product-type-create-modal"><?= __d('panel', 'Create') ?></button>
                    <div class="modal fade" id="js-product-type-create-modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <?= $this->Form->create($productType, ['url' => ['controller' => 'ProductTypes', 'action' => 'add']]) ?>
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><?= __d('panel', 'Add product type') ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <?php
                                            echo $this->Form->control('title', [
                                                'label' => __d('panel', 'Title') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                'placeholder' => __d('panel', 'Title'),
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
                    <table class="table table-bordered table-hover table-striped w-100 datatable">
                        <thead>
                            <tr>
                                <th class="all"></th>
                                <th class="all" style="min-width: 30%;"><?= __d('panel', 'Title') ?></th>
                                <th class="min-desktop"><?= __d('panel', 'Description') ?></th>
                                <th class="min-desktop"><?= __d('panel', 'Date created') ?></th>
                                <th class="all"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($productTypes as $productType): ?>
                            <tr>
                                <td class="text-center">
                                    <?php
                                    echo $this->Form->postLink(
                                        $this->Html->tag('i', '', ['class' => 'fal fa-trash']),
                                        $this->Url->build(['controller' => 'ProductTypes', 'action' => 'delete', h($productType->id)]),
                                        [
                                            'class' => 'color-danger-900',
                                            'data-title' => __d('panel', 'Are you sure you want to delete the product type?'),
                                            'data-message' => __d('panel', 'Deletion eliminates the possibility of data recovery.')
                                        ]
                                    );
                                    ?>
                                </td>
                                <td class="fs-lg">
                                    <?php
                                    echo $this->Html->link(
                                        h($productType->title),
                                        ['action' => 'view', h($productType->id)]
                                    );
                                    ?>
                                </td>
                                <td><?= $productType->description ?></td>
                                <td><?= $productType->date_created->format('d.m.Y H:i:s') ?></td>
                                <td>
                                    <a href="#" class="d-block text-center" data-toggle="modal" data-target="#js-product-type-edit-modal-<?= h($productType->id) ?>">
                                        <i class="fal fa-pencil"></i>
                                    </a>
                                    <div class="modal fade" id="js-product-type-edit-modal-<?= h($productType->id) ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                        <?= $this->Form->create($productType, ['url' => ['controller' => 'ProductTypes', 'action' => 'edit', h($productType->id)]]) ?>
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?= __d('panel', 'Add product type') ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12 mb-3">
                                                            <?php
                                                            echo $this->Form->control('title', [
                                                                'label' => __d('panel', 'Title') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                'placeholder' => __d('panel', 'Title'),
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