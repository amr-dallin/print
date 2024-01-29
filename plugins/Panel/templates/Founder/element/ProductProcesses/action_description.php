<dl class="row">
    <dt class="col-md-2 col-lg-1"><?= __d('panel', 'Group') ?></dt>
    <dd class="col-md-10 col-lg-11"><?= $this->ProductProcesses->groupTypeIcon($productProcess->group_type) ?></dd>

    <?php if (!empty($productProcess->description)): ?>
    <dt class="col-md-2 col-lg-1"><?= __d('panel', 'Description') ?></dt>
    <dd class="col-md-10 col-lg-11"><?= $productProcess->description ?></dd>
    <?php endif; ?>
</dl>
<div class="table-responsive-lg">
    <table class="table table-bordered">
        <thead class="thead-themed">
            <tr>
                <th><?= __d('panel', 'Name') ?></th>
                <th class="text-center"><?= __d('panel', 'Unit') ?></th>
                <th class="text-right"><?= __d('panel', 'Price') ?></th>
                <th class="text-center"><?= __d('panel', 'Quantity') ?></th>
                <th class="text-right"><?= __d('panel', 'Total') ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <?php
                    echo $this->Html->link(
                        h($productProcess->process_action->action_price->action->title),
                        ['controller' => 'Actions', 'action' => 'view', h($productProcess->process_action->action_price->action->id)]
                    );
                    ?>
                </td>
                <td class="text-center"><?= h($productProcess->process_action->action_price->action->unit->title) ?></td>
                <td class="text-right">
                    <?php
                    echo $this->Number->currency(
                        $productProcess->process_action->action_price->amount,
                        'UZS'
                    );
                    ?>
                </td>
                <td class="text-center"><?= h($productProcess->process_action->quantity) ?></td>
                <td class="text-right fw-700">
                    <?php
                    echo $this->Number->currency(
                        $this->ProcessActions->costPrice($productProcess->process_action),
                        'UZS'
                    );
                    ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>