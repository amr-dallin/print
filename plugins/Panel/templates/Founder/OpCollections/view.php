<?php
$this->assign('title', __d('panel', 'Operational printing collection #{0}', $opCollection->id));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['url' => ['action' => 'index'], 'title' => __d('panel', 'Operational printing collections')],
    ['title' => __d('panel', 'Operational printing collection #{0}', $opCollection->id)]
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
            targets: [4, 5],
            orderable: false
        }],
        pageLength: 50,
        order: [[0, 'asc']]
    });
});
</script>
<?php $this->end(); ?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-eye"></i> <?= __d('panel', 'Operational printing collection #{0}', $opCollection->id) ?>
    </h1>
</div>

<div id="panel-1" class="panel" data-panel-close data-panel-collapsed data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
    <div class="panel-hdr" role="heading">
        <h2><?= __d('panel', 'General information') ?></h2>
        <?php
        echo $this->Html->link(
            $this->Html->tag('i', '', ['class' => 'fad fa-file-pdf mr-1']) . __('pdf'),
            [$opCollection->id, '_ext' => 'pdf'],
            ['escape' => false, 'class' => 'btn btn-danger btn-xs mr-2']
        );
        echo $this->Html->link(
            $this->Html->tag('i', '', ['class' => 'fad fa-pencil mr-1']) . __('edit'),
            ['action' => 'edit', $opCollection->id],
            ['escape' => false, 'class' => 'btn btn-warning btn-xs mr-3']
        );
        ?>
    </div>
    <div class="panel-container show">
        <div class="panel-content">
            <dl class="row fs-xl mb-0">
                <dt class="col-md-3 col-lg-2 text-right"><?= __d('panel', 'Reporting period') ?>:</dt>
                <dd class="col-md-9 col-lg-10">
                    <?= $opCollection->date_from->format('d.m.Y') ?> - <?= $opCollection->date_to->format('d.m.Y') ?>
                </dd>
                <dt class="col-md-3 col-lg-2 text-right"><?= __d('panel', 'Collection date') ?>:</dt>
                <dd class="col-md-9 col-lg-10"><?= $opCollection->date_collection->format('d.m.Y') ?></dd>

                <?php if (!empty($opCollection->notes)): ?>
                <dt class="col-md-3 col-lg-2 text-right"><?= __d('panel', 'Notes') ?>:</dt>
                <dd class="col-md-9 col-lg-10"><?= $opCollection->notes ?></dd>
                <?php endif; ?>
            </dl>

            <?php
            if (!empty($opCollection->op_services)) {
                echo '<hr/>' . $this->element('OpCollections/pivotTable', ['opServices' => $opCollection->op_services]);
            }
            ?>
        </div>
    </div>
</div>

<div id="panel-2" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
    <div class="panel-hdr">
        <h2><?= __d('panel', 'Operational printing services') ?></h2>
    </div>
    <div class="panel-container show">
        <div class="panel-content">
            <?php if (!empty($opCollection->op_services)): ?>
            <table class="table table-bordered table-hover table-striped w-100 datatable">
                <thead>
                    <tr>
                        <th class="all"><?= __d('panel', 'Date') ?></th>
                        <th class="all text-center"><?= __d('panel', 'Type') ?></th>
                        <th class="all text-center"><?= __d('panel', 'Method') ?></th>
                        <th class="all text-right"><?= __d('panel', 'Amount'); ?></th>
                        <th class="all"><?= __d('panel', 'Notes') ?></th>
                        <th class="all"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($opCollection->op_services as $opService): ?>
                    <tr>
                        <td data-order="<?= $opService->date_of_service->format('c') ?>">
                            <?= $opService->date_of_service->format('d.m.Y') ?>
                        </td>
                        <td class="text-center"><?= $this->OpServices->typeList()[$opService->type] ?></td>
                        <td class="text-center"><?= $this->OpServices->methodList()[$opService->method] ?></td>
                        <td class="text-right"><?= $this->Number->currency($opService->amount, 'UZS', ['locale' => 'uz_UZ']) ?></td>
                        <td><?= $opService->notes ?></td>
                        <td class="text-center">
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag('i', '', ['class' => 'fal fa-pencil']),
                                ['controller' => 'OpServices', 'action' => 'edit', h($opService->id)],
                                ['escape' => false]
                            );
                            ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
                <div class="text-center text-info"><?= __d('panel', 'At the time of collection creation there were no unregistered services.') ?></div>
            <?php endif; ?>
        </div>
    </div>
</div>