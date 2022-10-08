<?php
$this->assign('title', __d('panel', 'Operational printing collectiojns'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Operational printing collections')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['op']['collections'][1] = true;
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
            targets: [0, 2, 5],
            orderable: false
        }],
        pageLength: 100,
        order: [[1, 'desc']]
    });
});
</script>
<?php $this->end(); ?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-align-left"></i> <?= __d('panel', 'Operational printing collections') ?>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Operational printing collections') ?></h2>
                <div class="panel-toolbar ml-auto mr-3">
                    <?= $this->Html->link(__d('panel', 'Create new'), ['action' => 'add'], ['class' => 'btn btn-xs btn-success']) ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <table class="table table-bordered table-hover table-striped w-100 datatable">
                        <thead>
                            <tr>
                                <th class="all"></th>
                                <th class="all text-center"><?= __d('panel', 'Date collection') ?></th>
                                <th class="all text-center"><?= __d('panel', 'Period') ?></th>
                                <th class="all text-center"><?= __d('panel', 'Quantity') ?></th>
                                <th class="all text-right"><?= __d('panel', 'Total'); ?></th>
                                <th class="all"><?= __d('panel', 'Notes') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($opCollections as $opCollection): ?>
                            <tr>
                                <td class="text-center">
                                    <?php
                                    echo $this->Html->link(
                                        $this->Html->tag('i', '', ['class' => 'fal fa-eye']),
                                        ['action' => 'view', h($opCollection->id)],
                                        ['escape' => false]
                                    );
                                    ?>
                                </td>
                                <td class="text-center" data-order="<?= $opCollection->date_collection->format('c') ?>">
                                    <?= $opCollection->date_collection->format('d.m.Y') ?>
                                </td>
                                <td class="text-center">
                                    <?= $opCollection->date_from->format('d.m.Y') ?> - <?= $opCollection->date_to->format('d.m.Y') ?>
                                </td>
                                <td class="text-center"><?= count($opCollection->op_services) ?></td>
                                <td class="text-right"><?= $this->OpServices->totalAmount($opCollection->op_services) ?></td>
                                <td><?= $opCollection->notes ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
