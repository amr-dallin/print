<div class="p-3 bg-danger-200 rounded overflow-hidden position-relative text-white mb-g">
    <div>
        <h3 class="fs-xxl d-block l-h-n m-0 fw-500 text-right">
            <?php
            echo $this->Number->currency(
                $this->Orders->totalCostPrice($orders), 'UZS'
            );
            ?>
            <small class="m-0 l-h-n"><?= __d('panel', 'Total cost price') ?></small>
        </h3>
    </div>
    <i class="fal fa-dollar-sign position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n4" style="font-size: 6rem;"></i>
</div>