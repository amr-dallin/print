<?php $this->append('script-code'); ?>
<script>
$(document).ready(function() {
    $('.datatable').dataTable({
        pageLength: 25,
        responsive: {
            details: {
                type: 'column', target: 'tr'
            }
        },
        columnDefs: [{
            targets: [0, 7],
            orderable: false
        }],
        order: [[6, 'asc']]
    });
});
</script>
<?php $this->end(); ?>

<table class="table table-bordered table-hover table-striped w-100 datatable">
    <thead>
        <tr>
            <th class="all"></th>
            <th class="all text-center"><?= __d('panel', 'Pouring') ?></th>
            <th class="all text-center"><?= __d('panel', 'Size') ?></th>
            <th class="min-tablet text-center"><?= __d('panel', 'Extra') ?></th>
            <th class="all text-right"><?= __d('panel', 'Price (monochrome)') ?></th>
            <th class="min-desktop"><?= __d('panel', 'Date commited') ?></th>
            <th class="all text-center"><?= __d('panel', 'Current') ?></th>
            <th class="all"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($laserMachine->laser_machine_rates as $laserMachineRate): ?>
        <tr>
            <td class="text-center">
                <?php
                echo $this->Form->postLink(
                    $this->Html->tag('i', '', ['class' => 'fal fa-trash']),
                    $this->Url->build(['controller' => 'LaserMachineRates', 'action' => 'delete', h($laserMachineRate->id)]),
                    [
                        'class' => 'color-danger-900',
                        'data-title' => __d('panel', 'Are you sure you want to delete the laser machine rate?'),
                        'data-message' => __d('panel', 'Deletion eliminates the possibility of data recovery.')
                    ]
                );
                ?>
            </td>
            <td class="text-center"><?= h($laserMachineRate->default_pouring) ?>%</td>
            <td class="text-center"><?= h($laserMachineRate->default_size) ?> (mm)<sup>2</sup></td>
            <td class="text-center"><?= h($laserMachineRate->extra) ?>%</td>
            <td class="text-right">
                <?php
                echo $this->Number->currency(
                    $this->LaserMachineRates->defaultMonochromePrice($laserMachineRate),
                    'UZS'
                );
                ?>
            </td>
            <td><?= $laserMachineRate->date_commited->format('d M Y') ?></td>
            <td class="text-center"><?= $this->Panel->boolIcon($laserMachineRate->is_current) ?></td>
            <td>
                <a href="#" class="d-block text-center" data-toggle="modal" data-target="#js-laser-machine-rate-<?= h($laserMachineRate->id) ?>-edit-modal">
                    <i class="fal fa-pencil"></i>
                </a>
                <div class="modal fade" id="js-laser-machine-rate-<?= h($laserMachineRate->id) ?>-edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <?= $this->Form->create($laserMachineRate, ['url' => ['controller' => 'LaserMachineRates', 'action' => 'edit', h($laserMachineRate->id)]]) ?>
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><?= __d('panel', 'Edit rate') ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
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
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>