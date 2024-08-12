<?php $this->append('script-code'); ?>
<script>
$(document).ready(function() {
    $("#product-process-<?= h($productProcess->id) ?>-paper-price-id").select2({
        dropdownParent: $("#js-product-process-<?= h($productProcess->id) ?>-add-paper-modal")
    });
    $("#product-process-<?= h($productProcess->id) ?>-consumable-price-id").select2({
        dropdownParent: $("#js-product-process-<?= h($productProcess->id) ?>-add-consumable-modal")
    });

    changeStatus();
    $('#product-process-<?= $productProcess->id ?>-status').on('change', function (){
        changeStatus();
    });
    function changeStatus() {
        var $status = $('#product-process-<?= $productProcess->id ?>-status');
        var $dateCompletedContainer = $('#product-process-<?= $productProcess->id ?>-date-completed-container');
        var $statusMessageContainer = $('#product-process-<?= $productProcess->id ?>-status-message-container');
        if ($status.val() == '<?= PRODUCT_PROCESSES_STATUS_IN_PROGRESS ?>') {
            $dateCompletedContainer.addClass('d-none');
            $dateCompletedContainer.find('input').prop('disabled', true);
            $statusMessageContainer.addClass('d-none');
            $statusMessageContainer.find('textarea').prop('disabled', true);
        } else if ($status.val() == '<?= PRODUCT_PROCESSES_STATUS_COMPLETED ?>') {
            $dateCompletedContainer.removeClass('d-none');
            $dateCompletedContainer.find('input').prop('disabled', false);
            $statusMessageContainer.addClass('d-none');
            $statusMessageContainer.find('textarea').prop('disabled', true);
        } else if ($status.val() == '<?= PRODUCT_PROCESSES_STATUS_PROBLEM ?>') {
            $dateCompletedContainer.addClass('d-none');
            $dateCompletedContainer.find('input').prop('disabled', true);
            $statusMessageContainer.removeClass('d-none');
            $statusMessageContainer.find('textarea').prop('disabled', false);
        }
    }
});
</script>
<?php $this->end(); ?>

<div class="table-responsive-lg mb-3">
    <table class="table table-sm table-bordered mb-0">
        <thead class="thead-themed">
            <tr>
                <th colspan="2" class="px-1 py-2">
                    <div class="d-flex justify-content-between">
                        <div>
                            <?php
                            if (
                                $this->Orders->isNotCompletedStatus($productProcess->order_product->order) &&
                                !$this->Orders->isEstimatedStatus($productProcess->order_product->order)
                            ) {
                                echo $this->ProductProcesses->statusSpinner($productProcess);
                            }
                            echo h($productProcess->full_name);
                            ?>
                        </div>
                        <div>
                            <?php if ($this->Orders->isNotCompletedStatus($productProcess->order_product->order)): ?>
                                <?php
                                echo $this->Form->postLink(
                                    $this->Html->tag('i', '', ['class' => 'fal fa-trash']),
                                    $this->Url->build(['controller' => 'ProductProcesses', 'action' => 'delete', h($productProcess->id)]),
                                    [
                                        'class' => 'color-danger-900 mr-1',
                                        'data-title' => __d('panel', 'Are you sure you want to delete the product process?'),
                                        'data-message' => __d('panel', 'Deletion eliminates the possibility of data recovery.')
                                    ]
                                );
                                ?>
                                <button type="button" class="btn btn-xs btn-success dropdown-toggle mr-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?= __d('panel', 'Add materials') ?>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#js-product-process-<?= h($productProcess->id) ?>-add-paper-modal">
                                        <?= __d('panel', 'Paper') ?>
                                    </button>
                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#js-product-process-<?= h($productProcess->id) ?>-add-consumable-modal">
                                        <?= __d('panel', 'Consumable') ?>
                                    </button>
                                </div>
                                <div class="modal fade fw-400" id="js-product-process-<?= h($productProcess->id) ?>-add-paper-modal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <?php
                                    echo $this->Form->create($processPaper, [
                                        'id' => "product-process-{$productProcess->id}-add-paper-form",
                                        'url' => ['controller' => 'ProcessPapers', 'action' => 'add', h($productProcess->id)]
                                    ]);
                                    ?>
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?= __d('panel', 'Add paper') ?></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <?php
                                                        echo $this->Form->control('product_process_id', [
                                                            'id' => "product-process-{$productProcess->id}-paper",
                                                            'type' => 'hidden',
                                                            'value' => h($productProcess->id)
                                                        ]);
                                                        echo $this->Form->control('paper_price_id', [
                                                            'label' => __d('panel', 'Paper') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                            'empty' => __d('panel', 'Select paper'),
                                                            'escape' => false,
                                                            'class' => 'select2',
                                                            'id' => "product-process-{$productProcess->id}-paper-price-id",
                                                            'options' => $papers
                                                        ]);
                                                        echo $this->Form->control('quantity', [
                                                            'id' => "product-process-{$productProcess->id}-paper-quantity",
                                                            'label' => __d('panel', 'Quantity') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                            'escape' => false
                                                        ]);
                                                        ?>        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= __d('panel', 'Close') ?></button>
                                                <?= $this->Form->submit(__d('panel', 'Save')) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?= $this->Form->end() ?>
                                </div>
                                <div class="modal fade fw-400" id="js-product-process-<?= h($productProcess->id) ?>-add-consumable-modal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <?php
                                    echo $this->Form->create($processConsumable, [
                                        'id' => "product-process-{$productProcess->id}-add-consumable-form",
                                        'url' => ['controller' => 'ProcessConsumables', 'action' => 'add', h($productProcess->id)]
                                    ]);
                                    ?>
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?= __d('panel', 'Add consumable') ?></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <?php
                                                        echo $this->Form->control('product_process_id', [
                                                            'id' => "product-process-{$productProcess->id}-consumable",
                                                            'type' => 'hidden',
                                                            'value' => h($productProcess->id)
                                                        ]);
                                                        echo $this->Form->control('consumable_price_id', [
                                                            'label' => __d('panel', 'Consumable') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                            'empty' => __d('panel', 'Select consumable'),
                                                            'escape' => false,
                                                            'class' => 'select2',
                                                            'id' => "product-process-{$productProcess->id}-consumable-price-id",
                                                            'options' => $consumables
                                                        ]);
                                                        echo $this->Form->control('quantity', [
                                                            'id' => "product-process-{$productProcess->id}-consumable-quantity",
                                                            'label' => __d('panel', 'Quantity') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                            'escape' => false
                                                        ]);
                                                        ?>        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= __d('panel', 'Close') ?></button>
                                                <?= $this->Form->submit(__d('panel', 'Save')) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?= $this->Form->end() ?>
                                </div>

                                <?php if (!$this->Orders->isEstimatedStatus($productProcess->order_product->order)): ?>
                                <button class="btn btn-xs btn-warning mr-1" type="button" data-toggle="modal" data-target="#js-product-process-<?= h($productProcess->id) ?>-change-status-modal">
                                    <?= __d('panel', 'Change status') ?>
                                </button>
                                <div class="modal fade fw-400" id="js-product-process-<?= h($productProcess->id) ?>-change-status-modal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <?php
                                    echo $this->Form->create($productProcess, [
                                        'id' => "product-process-{$productProcess->id}-change-status-form",
                                        'url' => ['controller' => 'ProductProcesses', 'action' => 'changeStatus', h($productProcess->id)]
                                    ]);
                                    ?>
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?= __d('panel', 'Change status') ?></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="alert alert-success mb-3 p-3">
                                                    <dl class="row mb-0">
                                                        <dt class="col-md-4 col-lg-3"><?= __d('panel', 'Unique ID') ?></dt>
                                                        <dd class="col-md-8 col-lg-9"><?= h($productProcess->unique_id) ?></dd>
                                                        <dt class="col-md-4 col-lg-3"><?= __d('panel', 'Title') ?></dt>
                                                        <dd class="col-md-8 col-lg-9"><?= h($productProcess->title) ?></dd>
                                                        <dt class="col-md-4 col-lg-3"><?= __d('panel', 'Group') ?></dt>
                                                        <dd class="col-md-8 col-lg-9 mb-0"><?= $this->ProductProcesses->groupTypeIcon($productProcess->group_type) ?></dd>
                                                    </dl>
                                                </div>

                                                <?php if ($this->ProductProcesses->isStatusProblem($productProcess->status) && !empty($productProcess->status_message)): ?>
                                                <dl class="row mb-3 text-danger">
                                                    <dt class="col-md-4 col-lg-3"><?= __d('panel', 'Message') ?></dt>
                                                    <dd class="col-md-8 col-lg-9"><?= $productProcess->status_message ?></dd>
                                                </dl>
                                                <?php endif; ?>

                                                <hr/>
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <?php
                                                        echo $this->Form->control('status', [
                                                            'label' => __d('panel', 'Status') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                            'escape' => false,
                                                            'id' => "product-process-{$productProcess->id}-status",
                                                            'options' => $this->ProductProcesses->statusList()
                                                        ]);
                                                        ?>
                                                        <div id="product-process-<?= $productProcess->id ?>-date-completed-container">
                                                            <?php
                                                            echo $this->Form->control('date_completed', [
                                                                'id' => "product-process-{$productProcess->id}-date-completed",
                                                                'label' => __d('panel', 'Date completed') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                                                'escape' => false,
                                                                'required' => true
                                                            ]);
                                                            ?>
                                                        </div>
                                                        <div id="product-process-<?= $productProcess->id ?>-status-message-container">
                                                            <?php
                                                            echo $this->Form->control('status_message', [
                                                                'id' => "product-process-{$productProcess->id}-status-message",
                                                                'label' => __d('panel', 'Message'),
                                                                'rows' => 3
                                                            ]);
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= __d('panel', 'Close') ?></button>
                                                <?= $this->Form->submit(__d('panel', 'Save')) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?= $this->Form->end() ?>
                                </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </th>
            </tr>
            <tr>
                <th><?= __d('panel', 'Name') ?></th>
                <th class="text-right w-25"><?= __d('panel', 'Price') ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <?php if ($this->ProductProcesses->isOutsourcing($productProcess->type)): ?>
                        <?php
                        echo $this->Html->link(
                            h($productProcess->contractor->title),
                            ['controller' => 'Contractors', 'action' => 'view', h($productProcess->contractor->id)]
                        );
                        ?>
                        <div class="mt-1"><?= $this->ProductProcesses->typeIcon($productProcess->type) ?></div>
                    <?php else: ?>
                    <a href="" data-toggle="modal" data-target="#js-product-process-<?= $productProcess->id ?>-description-modal">
                        <?= $this->ProductProcesses->title($productProcess) ?>
                    </a>
                    <div class="modal fade" id="js-product-process-<?= $productProcess->id ?>-description-modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><?= __d('panel', 'Process #{0}', h($productProcess->unique_id)) ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <?php
                                            if ($this->ProductProcesses->isActionProcess($productProcess)) {
                                                echo $this->element('ProductProcesses/action_description', ['productProcess' => $productProcess]);
                                            } elseif ($this->ProductProcesses->isLaserMachineProcess($productProcess)) {
                                                echo $this->element('ProductProcesses/laser_machine_description', ['productProcess' => $productProcess]);
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </td>
                <td class="text-right">
                    <?php
                    echo $this->Number->currency(
                        $productProcess->cost_price,
                        'UZS'
                    );
                    ?>
                </td>
            </tr>

            <?php if (!empty($productProcess->process_papers) || !empty($productProcess->process_consumables)): ?>
            <tr>
                <td colspan="2" class="py-2 fw-700 fs-xs"></td>
            </tr>
            <?php endif; ?>

            <?php if (!empty($productProcess->process_papers)): ?>
                <?php foreach($productProcess->process_papers as $processPaper): ?>
                <tr>
                    <td>
                        <a href="" data-toggle="modal" data-target="#js-process-paper-<?= h($processPaper->id) ?>-description-modal">
                            <?= $this->ProcessPapers->title($processPaper) ?>
                        </a>
                        <div class="modal fade" id="js-process-paper-<?= h($processPaper->id) ?>-description-modal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title"><?= $this->ProcessPapers->title($processPaper) ?></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12 mb-3">
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
                                                                        $this->ProcessPapers->title($processPaper),
                                                                        ['controller' => 'Papers', 'action' => 'view', h($processPaper->paper_price->paper->id)]
                                                                    );
                                                                    ?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?= h($processPaper->paper_price->paper->unit->title) ?>
                                                                </td>
                                                                <td class="text-right">
                                                                    <?= $this->Number->currency($processPaper->paper_price->amount, 'UZS') ?>
                                                                </td>
                                                                <td class="text-center"><?= h($processPaper->quantity) ?></td>
                                                                <td class="text-right fw-700">
                                                                    <?php
                                                                    echo $this->Number->currency(
                                                                        $this->ProcessPapers->costPrice($processPaper),
                                                                        'UZS'
                                                                    );
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="text-right">
                        <?php
                        echo $this->Number->currency(
                            $this->ProcessPapers->costPrice($processPaper), 'UZS'
                        );
                        ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if (!empty($productProcess->process_consumables)): ?>
                <?php foreach($productProcess->process_consumables as $processConsumable): ?>
                <tr>
                    <td>
                        <a href="" data-toggle="modal" data-target="#js-process-consumable-<?= h($processConsumable->id) ?>-description-modal">
                            <?= h($processConsumable->consumable_price->consumable->title) ?>
                        </a>
                        <div class="modal fade" id="js-process-consumable-<?= h($processConsumable->id) ?>-description-modal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title"><?= h($processConsumable->consumable_price->consumable->title) ?></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12 mb-3">
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
                                                                        h($processConsumable->consumable_price->consumable->title),
                                                                        [
                                                                            'controller' => 'Consumables',
                                                                            'action' => 'view',
                                                                            h($processConsumable->consumable_price->consumable->id)
                                                                        ]
                                                                    );
                                                                    ?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?= h($processConsumable->consumable_price->consumable->unit->title) ?>
                                                                </td>
                                                                <td class="text-right">
                                                                    <?= $this->Number->currency($processConsumable->consumable_price->amount, 'UZS') ?>
                                                                </td>
                                                                <td class="text-center"><?= h($processConsumable->quantity) ?></td>
                                                                <td class="text-right fw-700">
                                                                    <?php
                                                                    echo $this->Number->currency(
                                                                        $this->ProcessConsumables->costPrice($processConsumable),
                                                                        'UZS'
                                                                    );
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="text-right">
                        <?php
                        echo $this->Number->currency(
                            $this->ProcessConsumables->costPrice($processConsumable), 'UZS'
                        );
                        ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>

        </tbody>
        <tfoot class="thead-themed">
            <tr>
                <td class="text-right fw-700 py-2"><?= __d('panel', 'Total') ?>:</td>
                <td class="text-right fw-700 py-2">
                    <?php
                    echo $this->Number->currency(
                        $this->ProductProcesses->totalCostPrice($productProcess),
                        'UZS'
                    );
                    ?>
                </td>
            </tr>
        </tfoot>
    </table>
</div>