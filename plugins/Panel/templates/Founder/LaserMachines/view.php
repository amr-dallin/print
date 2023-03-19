<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $laserMachine
 */
$this->assign('title', h($laserMachine->title));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Directory')],
    ['title' => __d('panel', 'Printing machines')],
    ['title' => __d('panel', 'Laser machines'), 'url' => ['action' => 'index']],
    ['title' => h($laserMachine->title)]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['directory']['printing_machines']['laser_machines'] = true;
echo $this->element('press_navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css([
    'datagrid/datatables/datatables.bundle'
], ['block' => true]);

echo $this->Html->script([
    'datagrid/datatables/datatables.bundle'
], ['block' => true]);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function() {

    var $laserMachineCalculatorForm = $('#js-laser-machine-calculator-form');
    var $url = $laserMachineCalculatorForm.attr('rel');

    $laserMachineCalculatorForm.on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            type: 'post',
            url: $url,
            data: $laserMachineCalculatorForm.serialize(),
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            },
            success: function($response) {
                if ($response) {
                    $('#js-calculator-result').html($response);
                }
            },
            error: function(e) {
                console.log(e);
            }
        });
    });
});
</script>
<?php $this->end(); ?>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <div class="panel-toolbar ml-auto mr-3">
                    <button type="button" class="btn btn-xs btn-success mr-2" data-toggle="modal" data-target="#js-laser-machine-calculator-modal"><?= __d('panel', 'Calculator') ?></button>
                    <div class="modal fade" id="js-laser-machine-calculator-modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <form id="js-laser-machine-calculator-form" rel="<?= $this->Url->build(['action' => 'calculate', h($laserMachine->id), '_ext' => 'json']) ?>">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title"><?= __d('panel', 'Calculator') ?></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col mb-3">
                                                <?php
                                                echo $this->Form->control('pouring', [
                                                    'label' => __d('panel', 'Pouring (percentage)') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                    'required' => true,
                                                    'escape' => false,
                                                ]);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <?php
                                                echo $this->Form->control('width', [
                                                    'label' => __d('panel', 'Width (mm)') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                    'required' => true,
                                                    'escape' => false,
                                                ]);
                                                ?>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <?php
                                                echo $this->Form->control('height', [
                                                    'label' => __d('panel', 'Height (mm)') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                    'required' => true,
                                                    'escape' => false,
                                                ]);
                                                ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col mb-3 text-center">
                                                <span class="display-2 text-success" id="js-calculator-result">0 UZS</span>
                                            </div>
                                        </div>

                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= __d('panel', 'Close') ?></button>
                                        <?= $this->Form->submit(__d('panel', 'Calculate')) ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <h1 class="mb-3"><?= h($laserMachine->title) ?></h1>
                    <dl class="row fs-xl">
                        <dt class="col-md-3 col-lg-2"><?= __d('panel', 'Type') ?></dt>
                        <dd class="col-md-9 col-lg-10"><?= $this->LaserMachines->typeIcon($laserMachine->type) ?></dd>
                        
                        <?php if (!empty($laserMachine->description)): ?>
                        <dt class="col-md-3 col-lg-2"><?= __d('panel', 'Description') ?></dt>
                        <dd class="col-md-9 col-lg-10"><?= h($laserMachine->description) ?></dd>
                        <?php endif; ?>

                        <dt class="col-md-3 col-lg-2"><?= __d('panel', 'Status') ?></dt>
                        <dd class="col-md-9 col-lg-10"><?= $this->Panel->boolIcon($laserMachine->is_active) ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-2" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Rates') ?></h2>
                <div class="panel-toolbar ml-auto mr-3">
                    <button type="button" class="btn btn-xs btn-success mr-2" data-toggle="modal" data-target="#js-laser-machine-rate-create-modal"><?= __d('panel', 'Add rate') ?></button>
                    <div class="modal fade" id="js-laser-machine-rate-create-modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <?= $this->Form->create($laserMachineRate, ['url' => ['controller' => 'LaserMachineRates', 'action' => 'add']]) ?>
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><?= __d('panel', 'Add rate') ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <?php
                                        echo $this->Form->control('laser_machine_id', [
                                            'type' => 'hidden',
                                            'value' => $laserMachine->id
                                        ]);
                                        ?>
                                        <div class="col-md-6 mb-3">
                                            <?php
                                            echo $this->Form->control('default_pouring', [
                                                'label' => __d('panel', 'Default pouring') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                'escape' => false,
                                            ]);
                                            ?>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <?php
                                            echo $this->Form->control('default_size', [
                                                'label' => __d('panel', 'Default size') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                'escape' => false,
                                            ]);
                                            ?>
                                        </div>
                                    </div>

                                    <hr/>
                                    <h5 class="mb-3"><?= __d('panel', 'Toner (сost per impression for default values)') ?></h5>
                                    <?php
                                    if ($this->LaserMachines->isFullColorType($laserMachine->type)) {
                                        echo $this->element('LaserMachineRates/toner_full_color_form');
                                    } else {
                                        echo $this->element('LaserMachineRates/toner_monochrome_form');
                                    }
                                    ?>

                                    <hr/>
                                    <h5 class="mb-3"><?= __d('panel', 'Drum (сost per impression for default values)') ?></h5>
                                    <?php
                                    if ($this->LaserMachines->isFullColorType($laserMachine->type)) {
                                        echo $this->element('LaserMachineRates/drum_full_color_form');
                                    } else {
                                        echo $this->element('LaserMachineRates/drum_monochrome_form');
                                    }
                                    ?>

                                    <hr/>
                                    <h5 class="mb-3"><?= __d('panel', 'Developer (сost per impression for default values)') ?></h5>
                                    <?php
                                    if ($this->LaserMachines->isFullColorType($laserMachine->type)) {
                                        echo $this->element('LaserMachineRates/developer_full_color_form');
                                    } else {
                                        echo $this->element('LaserMachineRates/developer_monochrome_form');
                                    }
                                    ?>

                                    <hr/>
                                    <div class="row">
                                        <div class="col mb-3">
                                            <?php
                                            echo $this->Form->control('extra', [
                                                'label' => __d('panel', 'Extra (percentage)')
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <?php
                                            echo $this->Form->control('is_current', [
                                                'label' => __d('panel', 'Current') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                'escape' => false,
                                            ]);
                                            ?>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <?php
                                            echo $this->Form->control('date_commited', [
                                                'label' => __d('panel', 'Date commited') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                'escape' => false,
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= __d('panel', 'Close') ?></button>
                                    <?= $this->Form->submit(__d('panel', 'Save')) ?>
                                </div>
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <?php
                    if ($this->LaserMachines->isFullColorType($laserMachine->type)) {
                        echo $this->element('LaserMachineRates/full_color_table');
                    } else {
                        echo $this->element('LaserMachineRates/monochrome_table');
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>