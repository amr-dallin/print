<?php
$this->assign('title', __d('panel', 'Operational printing services analitics'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Operational printing services'), 'url' => ['action' => 'index']],
    ['title' => __d('panel', 'Analitics')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['op']['services'][2] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css('formplugins/bootstrap-daterangepicker/bootstrap-daterangepicker', ['block' => true]);
echo $this->Html->script('formplugins/bootstrap-daterangepicker/bootstrap-daterangepicker', ['block' => true]);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function() {
    $('#custom-range').daterangepicker(
    {
        "showDropdowns": true,
        "showWeekNumbers": true,
        "showISOWeekNumbers": true,
        "autoApply": true,
        ranges:
        {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        locale: {
            format: 'DD.MM.Y'
        },
    }, function(start, end, label)
    {
        console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });
});
</script>
<?php $this->end(); ?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-align-left"></i> <?= __d('panel', 'Operational printing services analitics') ?>
    </h1>
</div>

<div id="panel-1" class="panel" data-panel-close data-panel-collapsed data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
    <div class="panel-container show">
        <div class="panel-content">
            <form>
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" name="range" class="form-control form-control-lg" id="custom-range" value="<?= $this->request->getQuery('range') ?>" aria-describedby="button-addon5">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" id="button-addon5"><i class="fal fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </form>
            <hr/>
            <?php
            if (!empty($opServices)) {
                echo $this->element('OpCollections/pivotTable', ['opServices' => $opServices]);
            } else {
                echo $this->Html->tag('div', __('During this period there were no orders for operational printing.'), ['class' => 'text-warning text-center my-3']);
            }
            ?>
        </div>
    </div>
</div>