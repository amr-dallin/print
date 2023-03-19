<?php
$this->assign('title', __d('panel', 'Press dashboard'));
$this->assign('breadcrumbs', $this->element('breadcrumbs'));

$this->start('navigation');
$menu['dashboard'] = true;
echo $this->element('press_navigation', ['menu' => $menu]);
$this->end();
?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-chart-area"></i> <?= __d('panel', 'Dashboard') ?>
    </h1>
</div>

<div class="row">
    <div class="col-sm-6 col-xl-3">
        <?= $this->cell('Founder/Orders::totalCompleted') ?>
    </div>
    <div class="col-sm-6 col-xl-3">
        <?= $this->cell('Founder/Orders::totalSavedPrice') ?>
    </div>
    <div class="col-sm-6 col-xl-3">
        <?= $this->cell('Founder/Orders::totalProfitCost') ?>
    </div>
    <div class="col-sm-6 col-xl-3">
        <?= $this->cell('Founder/Orders::totalIncome') ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Top 5 internal clients') ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <?= $this->cell('Founder/Clients::topInternal') ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div id="panel-2" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Top 5 external clients') ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <?= $this->cell('Founder/Clients::topExternal') ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div id="panel-3" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Last 10 purchases') ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <?= $this->cell('Founder/PurchaseEntities::last') ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div id="panel-4" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Last 10 expenses') ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <?= $this->cell('Founder/Expenses::last') ?>
                </div>
            </div>
        </div>
    </div>
</div>