<?php
/**$client
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $client
 */
$this->assign('title', h($client->title));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Orders')],
    ['title' => __d('panel', 'Clients')],
    ['title' => $this->Clients->typeList()[h($client->type)] . ' ' . __d('panel', 'clients'), 'url' => ['action' => 'index', h($client->type)]],
    ['title' => h($client->title)]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['orders']['clients'][$this->Clients->navigationSlug(h($client->type))] = true;
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
    $('.datatable').dataTable({
        pageLength: 25,
        responsive: {
            details: {
                type: 'column', target: 'tr'
            }
        },
        columnDefs: [{
            targets: [7],
            orderable: false
        }],
        order: [[3, 'desc']]
    });
});
</script>
<?php $this->end(); ?>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'General') ?></h2>
                <div class="panel-toolbar ml-auto mr-3">
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('i', '', ['class' => 'fal fa-pencil mr-1']) . __d('panel', 'Edit'),
                        ['action' => 'edit', h($client->id)],
                        ['class' => 'btn btn-xs btn-warning', 'escape' => false]
                    );
                    ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="row">
                        <div class="col-md-8">
                            <h1 class="mb-3"><?= h($client->title) ?></h1>
                            <dl class="row fs-xl">
                                <dt class="col-md-3 col-lg-2"><?= __d('panel', 'Type') ?></dt>
                                <dd class="col-md-9 col-lg-10"><?= $this->Clients->typeIcon($client->type) ?></dd>

                                <?php if (!empty($client->discount)): ?>
                                <dt class="col-md-3 col-lg-2"><?= __d('panel', 'Discount') ?></dt>
                                <dd class="col-md-9 col-lg-10"><?= h($client->discount) ?>%</dd>
                                <?php endif; ?>
                                
                                <?php if (!empty($client->description)): ?>
                                <dt class="col-md-3 col-lg-2"><?= __d('panel', 'Description') ?></dt>
                                <dd class="col-md-9 col-lg-10"><?= h($client->description) ?></dd>
                                <?php endif; ?>
                            </dl>
                        </div>
                        <div class="col-md-4">
                            <div class="card shadow-none">
                                <div class="card-header bg-warning-50 py-1">
                                    <div class="card-title"><?= __d('panel', 'Representatives') ?></div>
                                </div>
                                <div class="card-body">
                                    <dl class="row fs-lg mb-0">
                                        <dt class="col-md-5"><?= __d('panel', 'First name') ?></dt>
                                        <dd class="col-md-7"><?= h($client->representative->first_name) ?></dd>
                                        
                                        <?php if (!empty($client->representative->second_name)): ?>
                                        <dt class="col-md-5"><?= __d('panel', 'Second name') ?></dt>
                                        <dd class="col-md-7"><?= h($client->representative->second_name) ?></dd>
                                        <?php endif; ?>

                                        <?php if (!empty($client->representative->sur_name)): ?>
                                        <dt class="col-md-5"><?= __d('panel', 'Surname') ?></dt>
                                        <dd class="col-md-7"><?= h($client->representative->sur_name) ?></dd>
                                        <?php endif; ?>
                                    </dl>
                                    <hr/>
                                    <dl class="row fs-lg mb-0">
                                        <dt class="col-md-5"><?= __d('panel', 'Phone number') ?></dt>
                                        <dd class="col-md-7">
                                            <?php
                                            echo $this->Html->link(
                                                $client->representative->phone_number->full_number,
                                                'tel:' . $client->representative->phone_number->full_number
                                            );
                                            ?>
                                        </dd>
                                        <?php if ($this->PhoneNumbers->isTelegram($client->representative->phone_number->is_telegram)): ?>
                                        <dt class="col-md-5"><?= __d('panel', 'Telegram') ?></dt>
                                        <dd class="col-md-7">
                                            <?php
                                            echo $this->Html->link(
                                                $this->Html->tag('i', '', ['class' => 'fab fa-telegram']),
                                                'https://t.me/' . $client->representative->phone_number->full_number,
                                                ['target' => '_blank', 'escape' => false, 'class' => 'fs-xxl']
                                            );
                                            ?>
                                        </dd>
                                        <?php endif; ?>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-2" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Orders') ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">

                    <div class="row">
                        <div class="col-lg-4">
                            <?= $this->cell('Founder/Orders::totalCompleted', [h($client->id)]) ?>
                        </div>
                        <div class="col-lg-4">
                            <?= $this->cell('Founder/Orders::totalCostPrice', [h($client->id)]) ?>
                        </div>
                        <?php if ($this->Clients->isInternal($client->type)): ?>
                        <div class="col-lg-4">
                            <?= $this->cell('Founder/Orders::totalSavedPrice', [h($client->id)]) ?>
                        </div>
                        <?php elseif ($this->Clients->isExternal($client->type)): ?>
                        <div class="col-lg-4">
                            <?= $this->cell('Founder/Orders::totalProfitCost', [h($client->id)]) ?>
                        </div>
                        <?php endif; ?>
                    </div>

                    <table class="table table-bordered table-hover table-striped w-100 datatable">
                        <thead>
                            <tr>
                                <th class="min-desktop text-center"><?= __d('panel', 'Unique ID') ?></th>
                                <th class="min-desktop"><?= __d('panel', 'Title') ?></th>
                                <th class="all text-center"><?= __d('panel', 'Products') ?></th>
                                <th class="min-desktop"><?= __d('panel', 'Date accepted') ?></th>
                                <th class="all"><?= __d('panel', 'Deadline') ?></th>
                                <th class="all"><?= __d('panel', 'Date completed') ?></th>
                                <th class="min-desktop text-center"><?= __d('panel', 'Status') ?></th>
                                <th class="all"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($client->orders as $order): ?>
                            <tr>
                                <td class="text-center"><?= h($order->unique_id) ?></td>
                                <td><?= h($order->title) ?></td>
                                <td class="text-center"><?= count($order->order_products) ?></td>
                                <td><?= $order->date_accepted->format('d.m.Y H:i') ?></td>
                                <td><?= $order->date_deadline->format('d.m.Y H:i') ?></td>
                                <td>
                                    <?php
                                    if (!empty($order->date_completed)) {
                                        echo $order->date_completed->format('d.m.Y H:i');
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?= $this->Orders->statusIcon($order->status) ?>
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