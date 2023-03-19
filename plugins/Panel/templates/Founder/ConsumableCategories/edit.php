<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $consumableCategory
 */
$this->assign('title', __d('panel', 'Edit consumable category'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Directory')],
    ['title' => __d('panel', 'Consumable categories'), 'url' => ['action' => 'index']],
    ['title' => __d('panel', 'Edit')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['directory']['consumables']['categories'] = true;
echo $this->element('press_navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css([], ['block' => true]);
echo $this->Html->script([], ['block' => true]);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function() {
    
});
</script>
<?php $this->end(); ?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-plus-circle"></i> <?= __d('panel', 'Edit consumable category') ?>
    </h1>
</div>

<?= $this->Form->create($consumableCategory) ?>
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
                    <div class="d-flex">
                        <?php
                        echo $this->Form->postLink(
                            $this->Html->tag('i', '', ['class' => 'fal fa-trash']) . ' ' . __d('panel', 'Delete'),
                            $this->Url->build(['action' => 'delete', h($consumableCategory->id)]),
                            [
                                'class' => 'color-danger-900 mt-2 pr-2 mr-auto',
                                'data-title' => __d('panel', 'Are you sure you want to delete the consumable category?'),
                                'data-message' => __d('panel', 'Deletion eliminates the possibility of data recovery.')
                            ]
                        );

                        echo $this->Form->submit(__d('panel', 'Save'));
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->Form->end() ?>