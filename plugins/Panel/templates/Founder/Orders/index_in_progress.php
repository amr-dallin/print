<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\Cake\Datasource\EntityInterface> $orders
 */
$this->assign('title', __d('panel', 'In progress orders'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Orders')],
    ['title' => __d('panel', 'In progress orders')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['orders']['by_status'][$this->Orders->navigationSlug(ORDERS_STATUS_IN_PROGRESS)] = true;
echo $this->element('press_navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css(['datagrid/datatables/datatables.bundle', 'formplugins/select2/select2.bundle'], ['block' => true]);
echo $this->Html->script(['datagrid/datatables/datatables.bundle', 'formplugins/select2/select2.bundle'], ['block' => true]);
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
        order: [[5, 'asc']]
    });
});
</script>
<?php $this->end(); ?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-table"></i> <?= __d('panel', 'In progress orders') ?>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-container show">
                <div class="panel-content">
                    <table class="table table-bordered table-hover table-striped w-100 datatable">
                        <thead>
                            <tr>
                                <th class="all text-center"><?= __d('panel', 'Unique ID') ?></th>
                                <th class="all text-center"><?= __d('panel', 'Type') ?></th>
                                <th class="all"><?= __d('panel', 'Client') ?></th>
                                <th class="all text-center"><?= __d('panel', 'Products') ?></th>
                                <th class="all"><?= __d('panel', 'Date accepted') ?></th>
                                <th class="all"><?= __d('panel', 'Deadline') ?></th>
                                <th class="all"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                            <tr>
                                <td class="text-center"><?= h($order->unique_id) ?></td>
                                <td class="text-center">
                                    <?= $this->Clients->typeIcon($order->client->type) ?>
                                </td>
                                <td>
                                    <?php
                                    echo $this->Html->link(h($order->client->title),
                                        ['controller' => 'Clients', 'action' => 'view', h($order->client->id)]
                                    );
                                    ?>
                                </td>
                                <td class="text-center"><?= count($order->order_products) ?></td>
                                <td><?= $order->date_accepted->format('d.m.Y H:i:s') ?></td>
                                <td data-order="<?= $order->date_deadline->format('c') ?>">
                                    <?= $order->date_deadline->format('d.m.Y H:i:s') ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    echo $this->Html->link(
                                        $this->Html->tag('i', '', ['class' => 'fal fa-eye']),
                                        ['controller' => 'Orders', 'action' => 'view', h($order->id)],
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