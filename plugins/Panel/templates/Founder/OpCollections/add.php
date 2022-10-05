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

echo $this->Html->css([
    'formplugins/bootstrap-daterangepicker/bootstrap-daterangepicker'
], ['block' => true]);
echo $this->Html->script([
    'formplugins/bootstrap-daterangepicker/bootstrap-daterangepicker'
], ['block' => true]);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function() {
    $('#js-date-range').daterangepicker(
    {
        "showDropdowns": true,
        "showWeekNumbers": true,
        "showISOWeekNumbers": true,
        "autoApply": true,
        "maxSpan":
        {
            "days": 7
        },
        ranges:
        {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        "alwaysShowCalendars": true,
        "startDate": "<?= date('d.m.Y') ?>",
        "endDate": "<?= date('d.m.Y') ?>",
        "applyButtonClasses": "btn-default shadow-0",
        "cancelClass": "btn-success shadow-0"
    }, function(start, end, label)
        {
            console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        });
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
                            echo $this->Form->control('date_range', [
                                'id' => 'js-date-range',
                                'label' => __d('panel', 'Date range') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
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
