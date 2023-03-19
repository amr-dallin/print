<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $contractor
 */
$this->assign('title', __d('panel', 'Edit contractor'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Orders')],
    ['title' => __d('panel', 'Contractors'), 'url' => ['action' => 'index']],
    ['title' => h($contractor->title), 'url' => ['action' => 'view', h($contractor->id)]],
    ['title' => __d('panel', 'Edit')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['orders']['contractors'] = true;
echo $this->element('press_navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css([
    'formplugins/select2/select2.bundle'
], ['block' => true]);

echo $this->Html->script(
    ['formplugins/select2/select2.bundle', 'formplugins/inputmask/inputmask.bundle'],
    ['block' => true]
);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function() {
    $('.select2').select2();
    $(":input").inputmask();
});
</script>
<?php $this->end(); ?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-pencil"></i> <?= __d('panel', 'Edit contractor') ?>
    </h1>
</div>

<?= $this->Form->create($contractor) ?>
<div class="row">
    <div class="col-md-9">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'General') ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <?php
                    echo $this->Form->control('title', [
                        'label' => __d('panel', 'Title') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                        'escape' => false,
                        'placeholder' => __d('panel', 'Title')
                    ]);
                    echo $this->Form->control('description', [
                        'placeholder' => __d('panel', 'Description'),
                        'rows' => 2
                    ]);
                    ?>
                </div>
            </div>
        </div>

        <div id="panel-3" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Representative') ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="row mb-3">
                        <div class="col-lg-4 mb-3 mb-lg-0">
                            <?php
                            echo $this->Form->control('representative.first_name', [
                                'label' => __d('panel', 'First name') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'placeholder' => __d('panel', 'First name')
                            ]);
                            ?>
                        </div>
                        <div class="col-lg-4 mb-3 mb-lg-0">
                            <?php
                            echo $this->Form->control('representative.second_name', [
                                'label' => __d('panel', 'Second name'),
                                'placeholder' => __d('panel', 'Second name')
                            ]);
                            ?>
                        </div>
                        <div class="col-lg-4 mb-3 mb-lg-0">
                            <?php
                            echo $this->Form->control('representative.sur_name', [
                                'label' => __d('panel', 'Surname'),
                                'placeholder' => __d('panel', 'Surname')
                            ]);
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 mb-3 mb-lg-0">
                            <?php
                            $this->Form->setTemplates([
                                'formGroup' => '{{label}}' .
                                    '<div class="input-group flex-nowrap">' .
                                        '<div class="input-group-prepend">' .
                                            '<span class="input-group-text">+998</span>' .
                                        '</div>' .
                                        '{{input}}' .
                                    '</div>'
                                ]);
                                echo $this->Form->control('representative.phone_number.number', [
                                    'label' => __d('panel', 'Phone number') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                    'escape' => false,
                                    'type' => 'tel',
                                    'maxlength' => false,
                                    'data-inputmask' => "'mask': '(99) 999-99-99'",
                                    'placeholder' => __d('panel', '(99) 999-99-99')
                                ]);
                                $this->Form->setTemplates(['formGroup' => '{{label}}{{input}}']);
                            ?>
                        </div>
                        <div class="col-lg-4 mb-3 mb-lg-0 pt-0 pt-lg-5">
                            <?php
                            echo $this->Form->control('representative.phone_number.is_telegram', [
                                'label' => __d('panel', 'with telegram'),
                                'type' => 'checkbox'
                            ]);
                            ?>
                        </div>
                    </div>
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