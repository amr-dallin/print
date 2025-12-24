<div class="text-dark">
    <div class="row">
        <div class="col-12">
            <div class="mb-5">
                <h1 class="mb-0">
                    <?= __d('panel', 'Printing house of Bucheon University in Tashkent') ?>
                    <small class="text-muted mb-0 fs-xs">
                        Чиланзарский район, ул.Катартал 2, дом 38А, Tashkent 100135
                    </small>
                </h1>
            </div>
            <h3 class="fw-300 display-4 fw-500 color-primary-600 pt-4 l-h-n m-0">
                <?= __d('panel', 'ORDER') ?>
            </h3>
            <div class="text-dark fw-700 h1 mb-g">
                # <?= h($order->unique_id) ?>
            </div>
        </div>
    </div>

    <div class="height-2"></div>

    <div class="row">
        <div class="col-12">
            <table>
                <tbody>
                    <tr>
                        <td style="width: 400px">
                            <?php if (!empty($order->date_accepted)): ?>
                            <dl class="row mb-0">
                                <dt class="col-5"><?= __d('panel', 'Date accepted') ?>:</dt>
                                <dd class="col-7"><?= $order->date_accepted->format('d.m.Y H:i') ?></dd>
                            </dl>
                            <?php endif; ?>

                            <?php if (!empty($order->date_deadline)): ?>
                            <dl class="row mb-0">
                                <dt class="col-5"><?= __d('panel', 'Deadline') ?>:</dt>
                                <dd class="col-7"><?= $order->date_deadline->format('d.m.Y H:i') ?></dd>
                            </dl>
                            <?php endif; ?>

                            <?php if (!empty($order->date_completed)): ?>
                            <dl class="row mb-0">
                                <dt class="col-5"><?= __d('panel', 'Date completed') ?>:</dt>
                                <dd class="col-7"><?= $order->date_completed->format('d.m.Y H:i') ?></dd>
                            </dl>
                            <?php endif; ?>
                        </td>
                        <td style="width: 600px;"></td>
                        <td style="width: 500px;">
                            <?php if($this->Orders->specifiedClient($order)): ?>
                            <dl class="row mb-0">
                                <dt class="col-4"><?= __d('panel', 'Title') ?>:</dt>
                                <dd class="col-8"><?= h($order->client->title) ?></dd>
                            </dl>
                            <dl class="row mb-0">
                                <dt class="col-4"><?= __d('panel', 'Type') ?>:</dt>
                                <dd class="col-8"><?= $this->Clients->typeIcon($order->client->type) ?></dd>
                            </dl>
                            <dl class="row mb-0">
                                <dt class="col-4"><?= __d('panel', 'Fullname') ?>:</dt>
                                <dd class="col-8"><?= h($order->client_full_name) ?></dd>
                            </dl>
                            <dl class="row mb-0">
                                <dt class="col-4"><?= __d('panel', 'Telephone') ?>:</dt>
                                <dd class="col-8"><?= h($order->client_telephone) ?></dd>
                            </dl>
                            <?php endif; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="height-8"></div>
    
    <?php
    if (!empty($order->order_products)) {
        if ($this->Clients->isInternal($order->client->type)) {
            echo $this->element('Orders/pdf/internal_client_table', ['order' => $order]);
        } elseif ($this->Clients->isExternal($order->client->type)) {
            echo $this->element('Orders/pdf/external_client_table', ['order' => $order]);
        }
    }
    ?>

    <div class="height-lg"></div>
    
    <table class="w-100 fs-lg">
        <tr>
            <td style="width: 70%;">
                <div class="fw-700 mb-3"><?= __d('panel', 'Executor') ?>:</div>
                <div class="mb-2">___________________________________</div>
                <div>___________________________________</div>
            </td>
            <td style="width: 30%;">
                <div class="fw-700 mb-2"><?= __d('panel', 'Customer') ?>:</div>
                <div class="mb-3"><?= h($order->client_full_name) ?></div>
                <div>___________________________________</div>
            </td>
        </tr>
    </table>

    <div class="height-8"></div>
</div>