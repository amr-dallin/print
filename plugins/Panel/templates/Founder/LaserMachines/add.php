<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $laserMachine
 */
$this->assign('title', __d('panel', 'Create laser machine'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Directory')],
    ['title' => __d('panel', 'Printing machines')],
    ['title' => __d('panel', 'Laser machines'), 'url' => ['action' => 'index']],
    ['title' => __d('panel', 'Create')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['directory']['printing_machines']['laser_machines'] = true;
echo $this->element('press_navigation', ['menu' => $menu]);
$this->end();
?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-plus-circle"></i> <?= __d('panel', 'Create laser machine') ?>
    </h1>
</div>

<?= $this->Form->create($laserMachine) ?>
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
                    echo $this->Form->control('type', [
                        'label' => __d('panel', 'Type') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                        'escape' => false,
                        'type' => 'radio',
                        'options' => [
                            '1' => __d('panel', 'Monochrome'),
                            '2' => __d('panel', 'Full colour')
                        ]
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
                    <?php
                    echo $this->Form->control('is_active', [
                        'label' => __d('panel', 'Active') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                        'escape' => false,
                    ]);
                    ?>
                    <div class="border-top pt-3 text-right">
                        <?= $this->Form->submit(__d('panel', 'Save')) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->Form->end() ?>