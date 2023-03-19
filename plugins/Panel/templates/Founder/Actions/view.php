<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $action
 */
$this->assign('title', h($action->title));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Directory')],
    ['title' => __d('panel', 'Actions'), 'url' => ['action' => 'index']],
    ['title' => h($action->title)]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['directory']['actions'] = true;
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

});
</script>
<?php $this->end(); ?>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Description') ?></h2>
                <div class="panel-toolbar ml-auto mr-3">
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('i', '', ['class' => 'fal fa-pencil mr-1']) . __d('panel', 'Edit'),
                        ['action' => 'edit', h($action->id)],
                        ['class' => 'btn btn-xs btn-warning', 'escape' => false]
                    );
                    ?>

                    <button type="button" class="btn btn-xs btn-success ml-2 mr-2" data-toggle="modal" data-target="#js-action-price-create-modal"><?= __d('panel', 'Set price') ?></button>
                    <div class="modal fade" id="js-action-price-create-modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <?= $this->Form->create($actionPrice, ['url' => ['controller' => 'ActionPrices', 'action' => 'add']]) ?>
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><?= __d('panel', 'Set price') ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <?php
                                        echo $this->Form->control('action_id', [
                                            'type' => 'hidden',
                                            'value' => h($action->id)
                                        ]);
                                        ?>
                                        <div class="col-12 mb-3">
                                            <?php
                                            echo $this->Form->control('amount', [
                                                'label' => __d('panel', 'Amount') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                'escape' => false,
                                            ]);
                                            ?>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <?php
                                            echo $this->Form->control('date_commited', [
                                                'label' => __d('panel', 'Date commited') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                'escape' => false,
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
                    </div>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <h1 class="mb-3"><?= h($action->title) ?></h1>
                    <dl class="row fs-xl">
                        <dt class="col-md-3 col-lg-2"><?= __d('panel', 'Type') ?></dt>
                        <dd class="col-md-9 col-lg-10"><?= $this->Actions->groupTypeIcon($action->group_type) ?></dd>
                        
                        <?php if (!empty($action->description)): ?>
                        <dt class="col-md-3 col-lg-2"><?= __d('panel', 'Description') ?></dt>
                        <dd class="col-md-9 col-lg-10"><?= h($action->description) ?></dd>
                        <?php endif; ?>

                        <dt class="col-md-3 col-lg-2"><?= __d('panel', 'Unit') ?></dt>
                        <dd class="col-md-9 col-lg-10"><?= $action->unit->title ?></dd>

                        <dt class="col-md-3 col-lg-2"><?= __d('panel', 'Price') ?></dt>
                        <dd class="col-md-9 col-lg-10 mb-0 text-success"><?= $this->Actions->currentPriceView($action->action_prices) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>