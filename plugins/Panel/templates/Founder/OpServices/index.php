<?php
$this->assign('title', __d('panel', 'Operational printing services'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Operational printing services')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['op']['services'][1] = true;
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
            targets: [0, 5, 6],
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
        <i class="subheader-icon fal fa-align-left"></i> <?= __d('panel', 'Operational printing services') ?>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Operational printing services') ?></h2>
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
                                <th class="all"><?= __d('panel', 'Date') ?></th>
                                <th class="all text-center"><?= __d('panel', 'Type') ?></th>
                                <th class="all text-center"><?= __d('panel', 'Method') ?></th>
                                <th class="all text-right"><?= __d('panel', 'Amount'); ?></th>
                                <th class="all"><?= __d('panel', 'Notes') ?></th>
                                <th class="all"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($opServices as $opService): ?>
                            <tr>
                                <td class="text-center">
                                    <?php
                                    echo $this->Form->postLink(
                                        $this->Html->tag('i', '', ['class' => 'fal fa-trash']),
                                        $this->Url->build(['action' => 'delete', h($opService->id)]),
                                        [
                                            'class' => 'color-danger-900',
                                            'data-title' => __d('panel', 'Are you sure you want to delete the operational printing service?'),
                                            'data-message' => __d('panel', 'Deletion eliminates the possibility of data recovery.')
                                        ]
                                    );
                                    ?>
                                </td>
                                <td data-order="<?= $opService->date_of_service->format('c') ?>">
                                    <?= $opService->date_of_service->format('d.m.Y') ?>
                                </td>
                                <td class="text-center"><?= $this->OpServices->typeList()[$opService->type] ?></td>
                                <td class="text-center"><?= $this->OpServices->methodList()[$opService->method] ?></td>
                                <td class="text-right"><?= $this->Number->currency($opService->amount, 'UZS') ?></td>
                                <td><?= $opService->notes ?></td>
                                <td class="text-center">
                                    <?php
                                    echo $this->Html->link(
                                        $this->Html->tag('i', '', ['class' => 'fal fa-pencil']),
                                        ['action' => 'edit', h($opService->id)],
                                        ['escape' => false]
                                    );
                                    ?>
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
