<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\Cake\Datasource\EntityInterface> $laserMachines
 */
$this->assign('title', __d('panel', 'Laser machines'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Directory')],
    ['title' => __d('panel', 'Printing machines')],
    ['title' => __d('panel', 'Laser machines')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['directory']['printing_machines']['laser_machines'] = true;
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
            targets: [4],
            orderable: false
        }],
        order: [[0, 'asc']]
    });
});
</script>
<?php $this->end(); ?>


<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-table"></i> <?= __d('panel', 'Laser machines') ?>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <div class="panel-toolbar ml-auto mr-3">
                    <?= $this->Html->link(__d('panel', 'Create new'), ['action' => 'add'], ['class' => 'btn btn-xs btn-success']) ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <table class="table table-bordered table-hover table-striped w-100 datatable">
                        <thead>
                            <tr>
                                <th class="all" style="min-width: 30%;"><?= __d('panel', 'Title') ?></th>
                                <th class="min-desktop text-center"><?= __d('panel', 'Type') ?></th>
                                <th class="min-desktop"><?= __d('panel', 'Description') ?></th>
                                <th class="all text-center"><?= __d('panel', 'Active') ?></th>
                                <th class="all"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($laserMachines as $laserMachine): ?>
                            <tr>
                                <td class="fs-lg"><?= h($laserMachine->title) ?></td>
                                <td class="text-center"><?= $this->LaserMachines->typeIcon($laserMachine->type) ?></td>
                                <td><?= $laserMachine->description ?></td>
                                <td class="text-center"><?= $this->Panel->boolIcon($laserMachine->is_active) ?></td>
                                <td class="text-center">
                                    <?php
                                    echo $this->Html->link(
                                        $this->Html->tag('i', '', ['class' => 'fal fa-eye']),
                                        ['action' => 'view', h($laserMachine->id)],
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