<h1 class="mb-5"><?= __d('panel', 'Reporting of the university printing house on operational printing') ?></h1>

<div class="alert alert alert-secondary">
    <dl class="row fs-lg mb-0">
        <dt class="col-3 text-right"><?= __d('panel', 'Reporting period') ?>:</dt>
        <dd class="col-9">
            <?= $opCollection->date_from->format('d.m.Y') ?> - <?= $opCollection->date_to->format('d.m.Y') ?>
        </dd>
    </dl>

    <dl class="row fs-lg mb-0">
        <dt class="col-3 text-right"><?= __d('panel', 'Collection date') ?>:</dt>
        <dd class="col-9"><?= $opCollection->date_collection->format('d.m.Y') ?></dd>
    </dl>

    <?php if (!empty($opCollection->notes)): ?>
    <dl class="row fs-xl mb-0">
        <dt class="col-3 text-right"><?= __d('panel', 'Notes') ?>:</dt>
        <dd class="col-9"><?= $opCollection->notes ?></dd>
    </dl>
    <?php endif; ?>
</div>

<?= $this->element('OpCollections/pivotTable', ['opServices' => $opCollection->op_services]) ?>

<div class="fs-lg mt-5">
    <?= __d('panel', 'The collection amount is {0}', '<b>' . $this->OpServices->paymentsByPaymentMethod($opCollection->op_services)[0] . '</b>') ?>.
</div>

<table class="w-100 fs-lg" style="margin-top: 200px;">
    <tr>
        <td style="width: 60%;">
            <div class="mb-5"><?= __d('panel', 'Handed over') ?>:</div>
            <div><span class="mr-3">_________________________</span>_________________</div>
        </td>
        <td style="width: 40%;">
            <div class="mb-5"><?= __d('panel', 'Collector') ?>:</div>
            <div><span class="mr-3">_________________________</span>_________________</div>
        </td>
    </tr>
</table>