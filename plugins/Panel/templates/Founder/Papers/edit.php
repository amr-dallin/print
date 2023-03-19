<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $paper
 */
$this->assign('title', __d('panel', 'Edit paper'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Directory')],
    ['title' => __d('panel', 'Papers'), 'url' => ['action' => 'index']],
    ['title' => h($paper->title), 'url' => ['action' => 'view', h($paper->id)]],
    ['title' => __d('panel', 'Edit')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['directory']['paper']['assortment'] = true;
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
        <i class="subheader-icon fal fa-pencil"></i> <?= __d('panel', 'Edit paper') ?>
    </h1>
</div>

<?= $this->Form->create($paper) ?>
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
                    ?>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <?php
                            echo $this->Form->control('paper_type_id', [
                                'class' => 'select2',
                                'label' => __d('panel', 'Type') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false
                            ]);
                            ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <?php
                            echo $this->Form->control('paper_format_id', [
                                'class' => 'select2',
                                'label' => __d('panel', 'Format, mm') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false
                            ]);
                            ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <?php
                            echo $this->Form->control('paper_density_id', [
                                'class' => 'select2',
                                'label' => __d('panel', 'Density, gr/m2') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false
                            ]);
                            ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <?php
                            echo $this->Form->control('paper_color_id', [
                                'class' => 'select2',
                                'label' => __d('panel', 'Color') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false
                            ]);
                            ?>
                        </div>
                    </div>

                    <?php
                    echo $this->Form->control('description', [
                        'placeholder' => __d('panel', 'Description'),
                        'rows' => 8
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
                            $this->Url->build(['action' => 'delete', h($paper->id)]),
                            [
                                'class' => 'color-danger-900 mt-2 pr-2 mr-auto',
                                'data-title' => __d('panel', 'Are you sure you want to delete the paper?'),
                                'data-message' => __d('panel', 'Deletion eliminates the possibility of data recovery.')
                            ]
                        );

                        echo $this->Form->submit(__d('panel', 'Save'));
                        ?>
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
                    echo $this->Form->control('initial_unit_id', [
                        'class' => 'select2',
                        'label' => __d('panel', 'Initial unit') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                        'escape' => false
                    ]);
                    ?>
                    <hr/>
                    <?php
                    echo $this->Form->control('unit_id', [
                        'class' => 'select2',
                        'label' => __d('panel', 'Unit') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                        'escape' => false
                    ]);
                    echo $this->Form->control('quantity', [
                        'label' => __d('panel', 'Quantity') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                        'escape' => false
                    ]);
                    ?>
                    
                </div>
            </div>
        </div>

    </div>
</div>
<?= $this->Form->end() ?>