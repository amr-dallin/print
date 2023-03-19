<?php if (!empty($expenses)): ?>
<div class="table-responsive-lg">
    <table class="table table-bordered m-0">
        <thead>
            <tr>
                <th><?= __d('panel', 'Title') ?></th>
                <th class="text-center"><?= __d('panel', 'Type') ?></th>
                <th class="text-center"><?= __d('panel', 'Quantity') ?></th>
                <th class="text-center"><?= __d('panel', 'Expensed') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($expenses as $expense): ?>
            <tr>
                <td>
                    <div class="d-block text-truncate" style="max-width: 250px;">
                        <?php
                        if ($this->Expenses->isPaper($expense->model)) {
                            echo $this->Html->link($expense->title,
                                ['controller' => 'Papers', 'action' => 'view', h($expense->foreign_key)]
                            );
                        } elseif ($this->Expenses->isConsumable($expense->model)) {
                            echo $this->Html->link($expense->title,
                                ['controller' => 'Consumables', 'action' => 'view', h($expense->foreign_key)]
                            );
                        }
                        ?>
                    </div>
                </td>
                <td class="text-center"><?= $this->Materials->modelIcon($expense) ?></td>
                <td class="text-center"><?= $expense->quantity ?></td>
                <td class="text-center">
                    <?= $expense->date_expensed->format('d.m.Y') ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php else: ?>
<div class="text-center text-info my-2"><?= __d('panel', 'There are currently no expenses') ?></div>
<?php endif; ?>