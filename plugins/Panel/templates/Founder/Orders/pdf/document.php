<style>
@media print {
  html,
  body {
    width: 210mm;
    height: 297mm; }
  .invoice-page {
    -webkit-print-color-adjust: exact; }
  .col-sm-1,
  .col-sm-2,
  .col-sm-3,
  .col-sm-4,
  .col-sm-5,
  .col-sm-6,
  .col-sm-7,
  .col-sm-8,
  .col-sm-9,
  .col-sm-10,
  .col-sm-11,
  .col-sm-12 {
    float: left;
    padding: 0; }
  .col-sm-12 {
    width: 100%; }
  .col-sm-11 {
    width: 91.66666667%; }
  .col-sm-10 {
    width: 83.33333333%; }
  .col-sm-9 {
    width: 75%; }
  .col-sm-8 {
    width: 66.66666667%; }
  .col-sm-7 {
    width: 58.33333333%; }
  .col-sm-6 {
    width: 50%; }
  .col-sm-5 {
    width: 41.66666667%; }
  .col-sm-4 {
    width: 33.33333333%; }
  .col-sm-3 {
    width: 25%; }
  .col-sm-2 {
    width: 16.66666667%; }
  .col-sm-1 {
    width: 8.33333333%; }
  div[data-size="A4"] {
    margin: 0;
    -webkit-box-shadow: 0;
            box-shadow: 0;
    padding: 3em 5em !important; }
  .breadcrumb,
  .subheader {
    display: none; }
  *:not(.keep-print-font) {
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 11pt !important; }
  table {
    font-size: 100% !important; } }

@page {
  size: auto;
  margin: 0; }

div[data-size="A4"] {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;

  background: url(../img/svg/pattern-1.svg) no-repeat center bottom;
  background-size: cover;
  padding: 4rem;
  position: relative; }

@media only screen and (max-width: 992px) {
  div[data-size="A4"],
  .container {
    padding: 0;
    -webkit-box-shadow: none;
            box-shadow: none; } }

/*# sourceMappingURL=page-invoice.css.map */
</style>

<div data-size="A4">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="fw-300 display-4 fw-500 color-primary-600 keep-print-font pt-4 l-h-n m-0">
                <?= __d('panel', 'ORDER') ?>
            </h3>
            <div class="text-dark fw-700 h1 mb-g keep-print-font">
                # <?= h($order->unique_id) ?>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-sm-4 d-flex">
            <div class="table-responsive">
                <table class="table table-clean table-sm align-self-end">
                    <tbody>
                        <?php if (!empty($order->date_accepted)): ?>
                        <tr class="text-info">
                            <td><?= __d('panel', 'Date accepted') ?>:</td>
                            <td><?= $order->date_accepted->format('d.m.Y H:i') ?></td>
                        </tr>
                        <?php endif; ?>

                        <?php if (!empty($order->date_deadline)): ?>
                        <tr class="text-danger fw-700">
                            <td><?= __d('panel', 'Deadline') ?>:</td>
                            <td><?= $order->date_deadline->format('d.m.Y H:i') ?></td>
                        </tr>
                        <?php endif; ?>

                        <?php if (!empty($order->date_completed)): ?>
                        <tr class="text-success fw-700">
                            <td><?= __d('panel', 'Date completed') ?>:</td>
                            <td><?= $order->date_completed->format('d.m.Y H:i') ?></td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm-4 ml-sm-auto">
            <?php if($this->Orders->specifiedClient($order)): ?>
            <div class="table-responsive">
                <table class="table table-sm table-clean">
                    <tbody>
                        <tr>
                            <td class="fw-700"><?= __d('panel', 'Title') ?>:</td>
                            <td><?= h($order->client->title) ?></td>
                        </tr>
                        <tr>
                            <td class="fw-700"><?= __d('panel', 'Type') ?>:</td>
                            <td><?= $this->Clients->typeIcon($order->client->type) ?></td>
                        </tr>
                        <tr>
                            <td class="fw-700"><?= __d('panel', 'Fullname') ?>:</td>
                            <td><?= h($order->client_full_name) ?></td>
                        </tr>
                        <tr>
                            <td class="fw-700"><?= __d('panel', 'Telephone') ?>:</td>
                            <td><?= h($order->client_telephone) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if (!empty($order->order_products)): ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table mt-5">
                    <thead>
                        <tr>
                            <th class="text-center border-top-0 table-scale-border-bottom fw-700"></th>
                            <th class="text-center border-top-0 table-scale-border-bottom fw-700"><?= __d('panel', 'Manufacturer') ?></th>
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
                            <td class="text-center"><?= $this->OrderProducts->typeIcon($orderProduct->type) ?></td>
                            <td class="text-left strong"><?= h($orderProduct->title) ?></td>
                            <td class="text-left"><?= h($orderProduct->description) ?></td>
                            <td class="text-right">
                                <?php
                                echo $this->Number->currency(
                                    $this->OrderProducts->costPriceOfOneCopy($orderProduct),
                                    'UZS'
                                );
                                ?>
                            </td>
                            <td class="text-center"><?= h($orderProduct->quantity) ?></td>
                            <td class="text-right">
                                <?= $this->Number->currency($orderProduct->cost_price, 'UZS') ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 ml-sm-auto">
                                                <table class="table table-clean">
                                                    <tbody>
                                                        <tr class="table-scale-border-top border-left-0 border-right-0 border-bottom-0">
                                                            <td class="text-left keep-print-font">
                                                                <h4 class="m-0 fw-700 h2 keep-print-font color-primary-700"><?= __d('panel', 'Cost price') ?></h4>
                                                            </td>
                                                            <td class="text-right keep-print-font">
                                                                <h4 class="m-0 fw-700 h2 keep-print-font">
                                                                    <?php
                                                                    echo $this->Number->currency(
                                                                        $order->cost_price,
                                                                        'UZS'
                                                                    );
                                                                    ?>
                                                                </h4>
                                                            </td>
                                                        </tr>

                                                        <?php if($this->Orders->specifiedClient($order)): ?>
                                                            <?php if ($this->Clients->isInternal($order->client->type)): ?>
                                                            <tr>
                                                                <td class="text-left keep-print-font my">
                                                                    <h4 class="m-0 fw-700 h3 keep-print-font color-warning-700"><?= __d('panel', 'Saved price') ?></h4>
                                                                </td>
                                                                <td class="text-right keep-print-font">
                                                                    <h4 class="m-0 fw-700 h3 keep-print-font">
                                                                        <?php
                                                                        echo $this->Number->currency(
                                                                            $order->saved_price,
                                                                            'UZS'
                                                                        );
                                                                        ?>
                                                                    </h4>
                                                                </td>
                                                            </tr>
                                                            <?php elseif ($this->Clients->isExternal($order->client->type)): ?>
                                                            <tr>
                                                                <td class="text-left keep-print-font my">
                                                                    <h4 class="m-0 fw-700 h3 keep-print-font color-success-700"><?= __d('panel', 'Profit price') ?></h4>
                                                                </td>
                                                                <td class="text-right keep-print-font">
                                                                    <h4 class="m-0 fw-700 h3 keep-print-font">
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
                                        <?php endif; ?>

                                        <div class="height-8"></div>
                                        
                                        <div class="row text-dark fs-xl">
                                            <div class="col-sm-4">
                                                <div class="fw-700 mb-2"><?= __d('panel', 'Executor') ?>:</div>
                                                <div class="mb-5"><?= __d('panel', 'Akhmetshin M.R.') ?></div>
                                                <div class="">___________________________________</div>
                                            </div>
                                            <?php if($this->Orders->specifiedClient($order)): ?>
                                            <div class="col-sm-4 ml-sm-auto">
                                                <div class="fw-700 mb-2"><?= __d('panel', 'Customer') ?>:</div>
                                                <div class="mb-5"><?= h($order->client_full_name) ?></div>
                                                <div class="">___________________________________</div>
                                            </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="height-8"></div>
                                    </div>