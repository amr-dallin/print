<?php if (!empty($opReceipts)): ?>
<div class="table-responsive-lg">
    <table class="table table-bordered m-0">
        <thead>
            <tr>
                <th><?= __d('panel', 'Title') ?></th>
                <th class="text-center"><?= __d('panel', 'Receipted') ?></th>
                <th class="text-right"><?= __d('panel', 'Amount') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($opReceipts as $opReceipt): ?>
            <tr>
                <td><?= h($opReceipt->title) ?></td>
                <td class="text-center"><?= $opReceipt->date_receipted->format('d.m.Y') ?></td>
                <td class="text-right">
                    <?= $this->Number->currency($opReceipt->amount, 'UZS'); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php else: ?>
<div class="text-center text-info my-2"><?= __d('panel', 'There are no receipts yet') ?></div>
<?php endif; ?>