<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $action
 */
$this->assign('title', __d('panel', 'Edit action'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Directory')],
    ['title' => __d('panel', 'Actions'), 'url' => ['action' => 'index']],
    ['title' => h($action->title), 'url' => ['action' => 'view', h($action->id)]],
    ['title' => __d('panel', 'Edit')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['directory']['actions'] = true;
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
        <i class="subheader-icon fal fa-pencil"></i> <?= __d('panel', 'Edit action') ?>
    </h1>
</div>

<?= $this->Form->create($action) ?>
<div class="row">
    <div class="col-md-9">
        <div id="panel-1" class="panel">
            <div class="panel-container show">
                <div class="panel-content">
                    <?php
                    echo $this->Form->control('title', [
                        'label' => __d('panel', 'Title') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                        'escape' => false,
                        'placeholder' => __d('panel', 'Title')
                    ]);
                    echo $this->Form->control('group_type', [
                        'type' => 'select',
                        'label' => __d('panel', 'Group') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                        'empty' => __d('panel', 'Select group'),
                        'options' => $this->Actions->groupTypeList(),
                        'escape' => false
                    ]);
                    echo $this->Form->control('description', [
                        'placeholder' => __d('panel', 'Description'),
                        'rows' => 2
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

        <div id="panel-3" class="panel shadow-0" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Measurement units') ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <?php
                    echo $this->Form->control('unit_id', [
                        'class' => 'select2',
                        'label' => __d('panel', 'Init') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                        'escape' => false
                    ]);
                    ?>                    
                </div>
            </div>
        </div>

    </div>
</div>
<?= $this->Form->end() ?>