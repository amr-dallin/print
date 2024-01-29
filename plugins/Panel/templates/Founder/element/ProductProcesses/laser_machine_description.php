<dl class="row">
    <dt class="col-md-2 col-lg-1"><?= __d('panel', 'Printer') ?></dt>
    <dd class="col-md-10 col-lg-11">
        <?php
        echo $this->Html->link(
            h($productProcess->process_laser_machine->laser_machine_rate->laser_machine->title),
            [
                'controller' => 'LaserMachines',
                'action' => 'view',
                h($productProcess->process_laser_machine->laser_machine_rate->laser_machine->id)
            ]
        );
        ?>
    </dd>
    <dt class="col-md-2 col-lg-1"><?= __d('panel', 'Group') ?></dt>
    <dd class="col-md-10 col-lg-11"><?= $this->ProductProcesses->groupTypeIcon($productProcess->group_type) ?></dd>
</dl>

<div class="table-responsive-lg">
    <table class="table table-bordered">
        <thead class="thead-themed">
            <tr>
                <th class="text-center"><?= __d('panel', 'Copies') ?></th>
                <th class="text-center"><?= __d('panel', 'Pages') ?></th>
                <th class="text-center"><?= __d('panel', 'Size') ?></th>
                <th class="text-center"><?= __d('panel', 'Chromaticity') ?></th>

                <?php if ($this->ProcessLaserMachines->isFullColor($productProcess->process_laser_machine)): ?>
                <th class="text-center"><?= __d('panel', 'C') ?></th>
                <th class="text-center"><?= __d('panel', 'M') ?></th>
                <th class="text-center"><?= __d('panel', 'Y') ?></th>
                <?php endif; ?>

                <th class="text-center"><?= __d('panel', 'K') ?></th>
                <th class="text-right"><?= __d('panel', 'Total') ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center"><?= h($productProcess->process_laser_machine->number_of_copies) ?></td>
                <td class="text-center"><?= h($productProcess->process_laser_machine->number_of_pages) ?></td>
                <td class="text-center"><?= h($productProcess->process_laser_machine->size) ?></td>
                <td class="text-center"><?= $this->ProcessLaserMachines->listOfPrintTypes()[$productProcess->process_laser_machine->print_type] ?></td>

                <?php if ($this->ProcessLaserMachines->isFullColor($productProcess->process_laser_machine)): ?>
                <td class="text-center"><?= h($productProcess->process_laser_machine->pouring_c_title) ?></td>
                <td class="text-center"><?= h($productProcess->process_laser_machine->pouring_m_title) ?></td>
                <td class="text-center"><?= h($productProcess->process_laser_machine->pouring_y_title) ?></td>
                <?php endif; ?>
                
                <td class="text-center"><?= h($productProcess->process_laser_machine->pouring_k_title) ?></td>
                <td class="text-right fw-700">
                    <?php
                    echo $this->Number->currency(
                        $productProcess->cost_price,
                        'UZS'
                    );
                    ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>