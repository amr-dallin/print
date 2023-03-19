<?php if (!empty($clients)): ?>
<div class="table-responsive-lg">
    <table class="table table-bordered m-0">
        <thead>
            <tr>
                <th><?= __d('panel', 'Title') ?></th>
                <th class="text-center"><?= __d('panel', 'Orders') ?></th>
                <th class="text-right"><?= __d('panel', 'Profit cost') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($clients as $client): ?>
            <tr>
                <td>
                    <div class="d-block text-truncate" style="max-width: 250px;">
                        <?php
                        echo $this->Html->link(h($client->title),
                            ['controller' => 'Clients', 'action' => 'view', h($client->id)]
                        );
                        ?>
                    </div>
                </td>
                <td class="text-center"><?= $client->quantity ?></td>
                <td class="text-right">
                    <?= $this->Number->currency($client->total_profit_cost, 'UZS'); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php else: ?>
<div class="text-center text-info my-2"><?= __d('panel', 'There are currently no orders from external clients') ?></div>
<?php endif; ?>