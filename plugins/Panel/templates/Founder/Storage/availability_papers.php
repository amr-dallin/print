<?php
/**
 * @var \App\View\AppView $this
 * $absentPapers
 * $availablePapers
 */
$this->assign('title', __d('panel', 'Availability papers'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Storage')],
    ['title' => __d('panel', 'Availability')],
    ['title' => __d('panel', 'Papers')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['storage']['availability']['papers'] = true;
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
        order: [[0, 'asc']]
    });
});
</script>
<?php $this->end(); ?>


<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-table"></i> <?= __d('panel', 'Availability papers') ?>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <div class="panel-toolbar ml-auto mr-3">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item ">
                            <a class="nav-link btn-xs active" data-toggle="tab" href="#js-pill-available-papers">
                                <?= __d('panel', 'Available') ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-xs" data-toggle="tab" href="#js-pill-absent-papers">
                                <?= __d('panel', 'Absent') ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="tab-content py-3">
                        <div class="tab-pane fade show active" id="js-pill-available-papers" role="tabpanel">
                            <table class="table table-bordered table-hover table-striped w-100 datatable">
                                <thead>
                                    <tr>
                                        <th class="all"><?= __d('panel', 'Title') ?></th>
                                        <th class="min-desktop"><?= __d('panel', 'Type') ?></th>
                                        <th class="all"><?= __d('panel', 'Format') ?></th>
                                        <th class="min-tablet text-center"><?= __d('panel', 'Density') ?></th>
                                        <th class="min-desktop"><?= __d('panel', 'Color') ?></th>
                                        <th class="all text-center"><?= __d('panel', 'Quantity') ?></th>
                                        <th class="all"><?= __d('panel', 'Unit') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($availablePapers as $paper): ?>
                                    <tr>
                                        <td>
                                            <?php
                                            echo $this->Html->link(
                                                h($paper->title),
                                                ['controller' => 'Papers', 'action' => 'view', $paper->id]
                                            );
                                            ?>
                                        </td>
                                        <td><?= h($paper->paper_type->title) ?></td>
                                        <td><?= h($paper->paper_format->full_name) ?></td>
                                        <td class="text-center"><?= h($paper->paper_density->density) ?></td>
                                        <td><?= h($paper->paper_color->title) ?></td>
                                        <td class="text-center fs-lg fw-700"><?= $this->Storage->availability($paper) ?></td>
                                        <td>
                                            <?php
                                            echo "{$paper->initial_unit->title} ({$paper->quantity} {$paper->unit->title})";
                                            ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade show" id="js-pill-absent-papers" role="tabpanel">
                            <table class="table table-bordered table-hover table-striped w-100 datatable">
                                <thead>
                                    <tr>
                                        <th class="all"><?= __d('panel', 'Title') ?></th>
                                        <th class="min-desktop"><?= __d('panel', 'Type') ?></th>
                                        <th class="all"><?= __d('panel', 'Format') ?></th>
                                        <th class="min-tablet text-center"><?= __d('panel', 'Density') ?></th>
                                        <th class="min-desktop"><?= __d('panel', 'Color') ?></th>
                                        <th class="all text-center"><?= __d('panel', 'Quantity') ?></th>
                                        <th class="all"><?= __d('panel', 'Unit') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($absentPapers as $paper): ?>
                                    <tr>
                                        <td>
                                            <?php
                                            echo $this->Html->link(
                                                h($paper->title),
                                                ['controller' => 'Papers', 'action' => 'view', $paper->id]
                                            );
                                            ?>
                                        </td>
                                        <td><?= h($paper->paper_type->title) ?></td>
                                        <td><?= h($paper->paper_format->full_name) ?></td>
                                        <td class="text-center"><?= h($paper->paper_density->density) ?></td>
                                        <td><?= h($paper->paper_color->title) ?></td>
                                        <td class="text-center fs-lg fw-700"><?= $this->Storage->availability($paper) ?></td>
                                        <td>
                                            <?php
                                            echo "{$paper->initial_unit->title} ({$paper->quantity} {$paper->unit->title})";
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
    </div>
</div>