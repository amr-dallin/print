<?php
$this->assign('title', __d('panel', 'Edit #{0}', $opService->id));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Operational printing services'), 'url' => ['action' => 'index']],
    ['title' => __d('panel', 'Edit #{0}', $opService->id)]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['op']['services'][1] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css([
    'formplugins/select2/select2.bundle'
], ['block' => true]);
echo $this->Html->script([
    'formplugins/select2/select2.bundle',
    'formplugins/inputmask/inputmask.bundle'
], ['block' => true]);
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
        <i class="subheader-icon fal fa-pencil"></i> <?= __d('panel', 'Edit #{0}', $opService->id) ?>
    </h1>
</div>

<?= $this->Form->create($opService) ?>
<div class="row">
    <div class="col-md-9">
        <div id="panel-1" class="panel">
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="row mb-3">
                        <div class="col-lg-3 mb-3 mb-lg-0">
                            <?php
                            echo $this->Form->control('date_of_service', [
                                'value' => date("d.m.Y"),
                                'label' => __d('panel', 'Date') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false
                            ]);
                            ?>
                        </div>
                        <div class="col-lg-3 mb-3 mb-lg-0">
                            <?php
                            echo $this->Form->control('type', [
                                'type' => 'select',
                                'label' => __d('panel', 'Type') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'empty' => __d('panel', 'Select service type'),
                                'options' => $this->OpServices->typeList(),
                                'escape' => false
                            ]);
                            ?>
                        </div>
                        <div class="col-lg-3 mb-3 mb-lg-0">
                            <?php
                            echo $this->Form->control('method', [
                                'type' => 'select',
                                'label' => __d('panel', 'Method') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'empty' => __d('panel', 'Select a payment method'),
                                'options' => $this->OpServices->methodList(),
                                'escape' => false
                            ]);
                            ?>
                        </div>
                        <div class="col-lg-3 mb-3 mb-lg-0">
                            <?php
                            echo $this->Form->control('amount', [
                                'label' => __d('panel', 'Amount') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'placeholder' => __d('panel', 'Amount'),
                                'escape' => false
                            ]);
                            ?>
                        </div>
                    </div>
                    <?php
                    echo $this->Form->control('notes', [
                        'label' => __d('panel', 'Notes'),
                        'rows' => 2,
                        'placeholder' => __d('panel', 'Notes')
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
