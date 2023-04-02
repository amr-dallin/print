<div class="row">
    <div class="col-12">
        <div class="table-responsive">
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th class="text-center border-top-0 table-scale-border-bottom fw-700"></th>
                        <th class="border-top-0 table-scale-border-bottom fw-700"><?= __d('panel', 'Title') ?></th>
                        <th class="border-top-0 table-scale-border-bottom fw-700"><?= __d('panel', 'Description') ?></th>
                        <th class="text-right border-top-0 table-scale-border-bottom fw-700"><?= __d('panel', 'Unit cost') ?></th>
                        <th class="text-center border-top-0 table-scale-border-bottom fw-700"><?= __d('panel', 'Quantity') ?></th>
                        <th class="text-right border-top-0 table-scale-border-bottom fw-700"><?= __d('panel', 'Cost price') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($order->order_products as $key => $orderProduct): ?>
                    <tr>
                        <td class="text-center fw-700"><?= $key + 1 ?></td>
                        <td class="text-left strong"><?= h($orderProduct->title) ?></td>
                        <td class="text-left"><?= h($orderProduct->description) ?></td>
                        <td class="text-right">
                            <?php
                            echo $this->Number->currency(
                                $this->OrderProducts->costPriceOfOneCopy($orderProduct), 'UZS'
                            );
                            ?>
                        </td>
                        <td class="text-center"><?= h($orderProduct->quantity) ?></td>
                        <td class="text-right">
                            <?php
                            echo $this->Number->currency(
                                $orderProduct->cost_price, 'UZS'
                            );
                            ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
    
<div class="row">
    <div class="col-12">
        <table style="width: 40%; margin-left: 60%">
            <tbody>
                <tr class="table-scale-border-top border-left-0 border-right-0 border-bottom-0">
                    <td class="text-left p-2">
                        <h4 class="m-0 fw-700 h2 color-primary-700"><?= __d('panel', 'Cost price') ?></h4>
                    </td>
                    <td class="text-right p-2">
                        <h4 class="m-0 fw-700 h2">
                            <?php
                            echo $this->Number->currency(
                                $order->cost_price, 'UZS'
                            );
                            ?>
                        </h4>
                    </td>
                </tr>
                
                <?php if($this->Orders->specifiedClient($order)): ?>
                    <?php if ($this->Clients->isInternal($order->client->type)): ?>
                    <tr>
                        <td class="text-left p-2">
                            <h4 class="m-0 fw-700 h3 color-warning-700"><?= __d('panel', 'Saved price') ?></h4>
                        </td>
                        <td class="text-right p-2">
                            <h4 class="m-0 fw-700 h3">
                                <?php
                                echo $this->Number->currency(
                                    $order->saved_price, 'UZS'
                                );
                                ?>
                            </h4>
                        </td>
                    </tr>
                    <?php elseif ($this->Clients->isExternal($order->client->type)): ?>
                    <tr>
                        <td class="text-left p-2">
                            <h4 class="m-0 fw-700 h3 color-success-700"><?= __d('panel', 'Profit price') ?></h4>
                        </td>
                        <td class="text-right p-2">
                            <h4 class="m-0 fw-700 h3">
                                <?= $this->Orders->profitPriceView($order) ?>
                            </h4>
                        </td>
                    </tr>
                    <?php endif; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>