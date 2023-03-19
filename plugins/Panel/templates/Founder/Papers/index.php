<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\Cake\Datasource\EntityInterface> $papers
 */
$this->assign('title', __d('panel', 'Papers'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Directory')],
    ['title' => __d('panel', 'Papers')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['directory']['paper']['assortment'] = true;
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
            targets: [6],
            orderable: false
        }],
        order: [[0, 'asc']]
    });
});
</script>
<?php $this->end(); ?>


<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-table"></i> <?= __d('panel', 'Papers') ?>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Papers') ?></h2>
                <div class="panel-toolbar ml-auto mr-3">
                    <?= $this->Html->link(__d('panel', 'Create new'), ['action' => 'add'], ['class' => 'btn btn-xs btn-success']) ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <table class="table table-bordered table-hover table-striped w-100 datatable">
                        <thead>
                            <tr>
                                <th class="all"><?= __d('panel', 'Title') ?></th>
                                <th class="min-desktop"><?= __d('panel', 'Type') ?></th>
                                <th class="all"><?= __d('panel', 'Format') ?></th>
                                <th class="min-tablet text-center"><?= __d('panel', 'Density') ?></th>
                                <th class="min-desktop"><?= __d('panel', 'Color') ?></th>
                                <th class="all"><?= __d('panel', 'Unit') ?></th>
                                <th class="all"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($papers as $paper): ?>
                            <tr>
                                <td>
                                    <?php
                                    echo $this->Html->link(
                                        h($paper->title),
                                        ['action' => 'view', h($paper->id)]
                                    );
                                    ?>
                                </td>
                                <td><?= h($paper->paper_type->title) ?></td>
                                <td><?= h($paper->paper_format->full_name) ?>
                                </td>
                                <td class="text-center"><?= h($paper->paper_density->density) ?></td>
                                <td><?= h($paper->paper_color->title) ?></td>
                                <td>
                                    <?php
                                    echo "{$paper->initial_unit->title} ({$paper->quantity} {$paper->unit->title})";
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    echo $this->Html->link(
                                        $this->Html->tag('i', '', ['class' => 'fal fa-pencil']),
                                        ['action' => 'edit', h($paper->id)],
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