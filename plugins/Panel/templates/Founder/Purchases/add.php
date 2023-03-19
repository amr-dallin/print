<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $purchase
 */
$this->assign('title', __d('panel', 'Create purchase'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Storage')],
    ['title' => __d('panel', 'Purchases'), 'url' => ['action' => 'index']],
    ['title' => __d('panel', 'Create')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['storage']['purchases'] = true;
echo $this->element('press_navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css([
    'formplugins/select2/select2.bundle'
], ['block' => true]);

echo $this->Html->script(
    ['formplugins/select2/select2.bundle'],
    ['block' => true]
);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function() {
    $('.select2').select2();
});
</script>
<?php $this->end(); ?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-plus-circle"></i> <?= __d('panel', 'Create purchase') ?>
    </h1>
</div>

<?= $this->Form->create($purchase) ?>
<div class="row">
    <div class="col-md-9">
        <div id="panel-1" class="panel">
            <div class="panel-container show">
                <div class="panel-content">
                    <?php
                    echo $this->Form->control('supplier_id', [
                        'label' => __d('panel', 'Supplier') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                        'class' => 'select2',
                        'escape' => false
                    ]);
                    ?>

                    <?php
                    echo $this->Form->control('description', [
                        'placeholder' => __d('panel', 'Description')
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div id="panel-2" class="panel shadow-0" data-panel-close data-panel-collapsed data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Publish mode') ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="text-right">
                        <?= $this->Form->submit(__d('panel', 'Save')) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->Form->end() ?>