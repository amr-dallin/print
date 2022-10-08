<div class="table-responsive-lg">
    <table class="table table-bordered m-0 fs-lg">
        <thead class="fw-700 thead-themed">
            <tr>
                <th rowspan="2" class="align-middle w-50"><?= __d('panel', 'Name of service') ?></th>
                <th colspan="2" class="text-center"><?= __d('panel', 'Quantity') ?></th>
                <th colspan="2" class="text-center"><?= __d('panel', 'Amount') ?></th>
            </tr>
            <tr>
                <th class="text-center" style="width: 10%;"><?= __d('panel', 'Cash') ?></th>
                <th class="text-center" style="width: 10%;"><?= __d('panel', 'Transfer') ?></th>
                <th class="text-center" style="width: 15%;"><?= __d('panel', 'Cash') ?></th>
                <th class="text-center" style="width: 15%;"><?= __d('panel', 'Transfer') ?></th>
            </tr>
        </thead>
        <tfoot>
            <tr class="fw-700">
                <td colspan="3" class="text-right"><?= __d('panel', 'Total amount') ?>:</td>
                <td class="text-right"><?= $this->OpServices->paymentsByPaymentMethod($opServices)[0] ?></td>
                <td class="text-right"><?= $this->OpServices->paymentsByPaymentMethod($opServices)[1] ?></td>
            </tr>
        </tfoot>
        <tbody>
            <?php foreach($this->OpServices->tabularCalculations($opServices) as $key => $service): ?>
            <tr>
                <td><?= $this->OpServices->typeList()[$key] ?></td>
                <td class="text-center"><?= $service[0] ?></td>
                <td class="text-center"><?= $service[1] ?></td>
                <td class="text-right"><?= $service[2] ?></td>
                <td class="text-right"><?= $service[3] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>