<?php if (!empty($purchaseEntities)): ?>
<div class="table-responsive-lg">
    <table class="table table-bordered m-0">
        <thead>
            <tr>
                <th><?= __d('panel', 'Title') ?></th>
                <th class="text-center"><?= __d('panel', 'Type') ?></th>
                <th class="text-center"><?= __d('panel', 'Quantity') ?></th>
                <th class="text-center"><?= __d('panel', 'Purchased') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($purchaseEntities as $purchaseEntity): ?>
            <tr>
                <td>
                    <div class="d-block text-truncate" style="max-width: 250px;">
                        <?php
                        if ($this->Expenses->isPaper($purchaseEntity->model)) {
                            echo $this->Html->link($purchaseEntity->title,
                                ['controller' => 'Papers', 'action' => 'view', h($purchaseEntity->foreign_key)]
                            );
                        } elseif ($this->Expenses->isConsumable($purchaseEntity->model)) {
                            echo $this->Html->link($purchaseEntity->title,
                                ['controller' => 'Consumables', 'action' => 'view', h($purchaseEntity->foreign_key)]
                            );
                        }
                        ?>
                    </div>
                </td>
                <td class="text-center"><?= $this->Materials->modelIcon($purchaseEntity) ?></td>
                <td class="text-center"><?= $purchaseEntity->quantity ?></td>
                <td class="text-center">
                    <?= $purchaseEntity->purchase->date_purchased->format('d.m.Y') ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php else: ?>
<div class="text-center text-info my-2"><?= __d('panel', 'There are currently no purchases') ?></div>
<?php endif; ?>