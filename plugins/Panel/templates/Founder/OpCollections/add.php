<?php
$this->assign('title', __d('panel', 'Create operational printing collection'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Operational printing collection'), 'url' => ['action' => 'index']],
    ['title' => __d('panel', 'Create')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['op']['collections'][0] = true;
echo $this->element('navigation', ['menu' => $menu]);
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
        <i class="subheader-icon fal fa-plus-circle"></i> <?= __d('panel', 'Create operational printing collection') ?>
    </h1>
</div>

<?= $this->Form->create($opCollection) ?>
<div class="row">
    <div class="col-md-9">
        <div id="panel-1" class="panel">
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="row mb-3">
                        <div class="col-12">
                            <?php
                            echo $this->Form->control('date_collection', [
                                'value' => date("d.m.Y"),
                                'label' => __d('panel', 'Date collection') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false
                            ]);
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
