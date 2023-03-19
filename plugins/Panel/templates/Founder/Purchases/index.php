<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\Cake\Datasource\EntityInterface> $purchases
 */

$this->assign('title', __d('panel', 'Purchases'));

$this->start('breadcrumbs');
$breadcrumbs[] = ['title' => __d('panel', 'Storage')];
if (null !== $this->request->getQuery('range')) {
    $breadcrumbs[] = ['title' => __d('panel', 'Purchases'), 'url' => ['action' => 'index']];
    $breadcrumbs[] = ['title' => $this->request->getQuery('range')];
} else {
    $breadcrumbs[] = ['title' => __d('panel', 'Purchases')];
}
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['storage']['purchases'] = true;
echo $this->element('press_navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css([
    'datagrid/datatables/datatables.bundle',
    'formplugins/bootstrap-daterangepicker/bootstrap-daterangepicker'
], ['block' => true]);
echo $this->Html->script([
    'datagrid/datatables/datatables.bundle',
    'formplugins/bootstrap-daterangepicker/bootstrap-daterangepicker'
], ['block' => true]);
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
            targets: [5],
            orderable: false
        }],
        order: [[3, 'desc']]
    });

    $('#custom-range').daterangepicker(
    {
        "showDropdowns": true,
        "showWeekNumbers": true,
        "showISOWeekNumbers": true,
        "autoApply": true,
        ranges:
        {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        locale: {
            format: 'DD.MM.Y'
        },
    }, function(start, end, label)
    {
        console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });
});
</script>
<?php $this->end(); ?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-table"></i> <?= __d('panel', 'Purchases') ?>
    </h1>
</div>

<div id="panel-1" class="panel" data-panel-close data-panel-collapsed data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
    <div class="panel-container show">
        <div class="panel-hdr">
            <div class="panel-toolbar ml-auto">
                <?= $this->Html->link(__d('panel', 'Create new'), ['action' => 'add'], ['class' => 'btn btn-xs btn-success']) ?>
            </div>
        </div>
        <div class="panel-content">
            <form>
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" name="range" class="form-control form-control-lg" id="custom-range" value="<?= $this->request->getQuery('range') ?>" aria-describedby="button-addon5">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" id="button-addon5"><i class="fal fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </form>
            <hr/>
            <?php if (!empty($purchases)): ?>

            <div class="alert alert-success">
                <dl class="row text-right fs-xxl mb-0">
                    <dt class="col-lg-9"><?= __d('panel', 'Papers') ?>:</dt>
                    <dd class="col-lg-3"><?= $this->Number->currency($this->Purchases->totalPapers($purchases), 'UZS') ?></dd>
                    <dt class="col-lg-9"><?= __d('panel', 'Consumables') ?>:</dt>
                    <dd class="col-lg-3"><?= $this->Number->currency($this->Purchases->totalConsumables($purchases), 'UZS') ?></dd>
                    <dt class="col-lg-9"><?= __d('panel', 'All') ?>:</dt>
                    <dd class="col-lg-3 mb-0"><?= $this->Number->currency($this->Purchases->totalAll($purchases), 'UZS') ?></dd>
                </dl>
            </div>

            <table class="table table-bordered table-hover table-striped w-100 datatable">
                <thead>
                    <tr>
                        <th class="min-desktop"><?= __d('panel', 'Supplier') ?></th>
                        <th class="all text-center"><?= __d('panel', 'Quantity') ?></th>
                        <th class="min-tablet text-right"><?= __d('panel', 'Total') ?></th>
                        <th class="min-desktop"><?= __d('panel', 'Date purchased') ?></th>
                        <th class="all text-center"><?= __d('panel', 'Status') ?></th>
                        <th class="all"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($purchases as $purchase): ?>
                    <tr>
                        <td>
                            <?php
                            echo $this->Html->link($purchase->supplier->title, [
                                'controller' => 'Suppliers',
                                'action' => 'view',
                                $purchase->supplier_id
                            ]);
                            ?>
                        </td>
                        <td class="text-center"><?= count($purchase->purchase_entities) ?></td>
                        <td class="text-right">
                            <?php
                            if ($this->Purchases->isApproved($purchase)) {
                                echo $this->Number->currency($this->Purchases->total($purchase->purchase_entities), 'UZS');
                            }
                            ?>
                        </td>
                        <td data-order="<?= ($this->Purchases->isApproved($purchase)) ? $purchase->date_purchased->format('c') : '' ?>">
                            <?= ($this->Purchases->isApproved($purchase)) ? $purchase->date_purchased->format('d.m.Y') : '' ?>
                        </td>
                        <td class="text-center"><?= $this->Purchases->statusIcon($purchase) ?></td>
                        <td class="text-center">
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag('i', '', ['class' => 'fal fa-eye']),
                                ['action' => 'view', h($purchase->id)],
                                ['escape' => false]
                            );
                            ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
                <?= $this->Html->tag('div', __('There were no purchases during this time period.'), ['class' => 'text-warning text-center my-3']) ?>
            <?php endif; ?>
        </div>
    </div>
</div>