<?php if (!empty($opExpenses)): ?>
<div class="table-responsive-lg">
    <table class="table table-bordered m-0">
        <thead>
            <tr>
                <th><?= __d('panel', 'Title') ?></th>
                <th class="text-center"><?= __d('panel', 'Expensed') ?></th>
                <th class="text-right"><?= __d('panel', 'Amount') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($opExpenses as $opExpense): ?>
            <tr>
                <td><?= h($opExpense->title) ?></td>
                <td class="text-center"><?= $opExpense->date_expensed->format('d.m.Y') ?></td>
                <td class="text-right">
                    <?= $this->Number->currency($opExpense->amount, 'UZS'); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php else: ?>
<div class="text-center text-info my-2"><?= __d('panel', 'There are no expenses yet') ?></div>
<?php endif; ?>