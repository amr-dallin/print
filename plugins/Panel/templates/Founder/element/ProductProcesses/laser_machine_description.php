<dl class="row">
    <dt class="col-md-3 col-lg-2"><?= __d('panel', 'Printer') ?></dt>
    <dd class="col-md-9 col-lg-10">
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
    <dt class="col-md-3 col-lg-2"><?= __d('panel', 'Group') ?></dt>
    <dd class="col-md-9 col-lg-10"><?= $this->ProductProcesses->groupTypeIcon($productProcess->group_type) ?></dd>

    <?php if (!empty($productProcess->description)): ?>
    <dt class="col-md-3 col-lg-2"><?= __d('panel', 'Description') ?></dt>
    <dd class="col-md-9 col-lg-10"><?= $productProcess->description ?></dd>
    <?php endif; ?>
</dl>

<div class="table-responsive-lg">
    <table class="table table-bordered">
        <thead class="thead-themed">
            <tr>
                <th class="text-center"><?= __d('panel', 'Copies') ?></th>
                <th class="text-center"><?= __d('panel', 'Pages') ?></th>
                <th class="text-center"><?= __d('panel', 'Size') ?></th>
                <th class="text-center"><?= __d('panel', 'Chromaticity') ?></th>
                <th class="text-center"><?= __d('panel', 'Pouring') ?></th>
                <th class="text-right"><?= __d('panel', 'Total') ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center"><?= h($productProcess->process_laser_machine->number_of_copies) ?></td>
                <td class="text-center"><?= h($productProcess->process_laser_machine->number_of_pages) ?></td>
                <td class="text-center"><?= h($productProcess->process_laser_machine->size) ?></td>
                <td class="text-center"><?= $this->ProcessLaserMachines->listOfPrintTypes()[$productProcess->process_laser_machine->print_type] ?></td>
                <td class="text-center"><?= h($productProcess->process_laser_machine->pouring_title) ?></td>
                <td class="text-right fw-700">
                    <?php
                    echo $this->Number->currency(
                        $this->ProcessLaserMachines->costPrice($productProcess->process_laser_machine),
                        'UZS'
                    );
                    ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>