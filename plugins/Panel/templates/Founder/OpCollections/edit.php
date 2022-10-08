<?php
$this->assign('title', __d('panel', 'Operational printing collection #{0}', $opCollection->id));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['url' => ['action' => 'index'], 'title' => __d('panel', 'Operational printing collections')],
    ['title' => __d('panel', 'Operational printing collection #{0}', $opCollection->id)]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['op']['collections'][1] = true;
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
    <i class="subheader-icon fal fa-pencil"></i> <?= __d('panel', 'Operational printing collection #{0}', $opCollection->id) ?>
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
                    <div class="d-flex">
                        <?php
                        echo $this->Form->postLink(
                            $this->Html->tag('i', '', ['class' => 'fal fa-trash']) . ' ' . __('Delete'),
                            $this->Url->build(['action' => 'delete', h($opCollection->id)]),
                            [
                                'class' => 'color-danger-900 mt-2 pr-2 mr-auto',
                                'data-title' => __('Are you sure you want to delete the collection?'),
                                'data-message' => __('Deletion eliminates the possibility of data recovery.')
                            ]
                        );
                        echo $this->Form->submit(__('Save'));
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->Form->end() ?>
