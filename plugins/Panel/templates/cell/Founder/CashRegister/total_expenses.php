<div class="p-3 bg-danger-200 rounded overflow-hidden position-relative text-white mb-g">
    <div>
        <h3 class="fs-xxl d-block l-h-n m-0 fw-500 text-right">
            <?php
            echo $this->Number->currency(
                $this->CashRegister->totalExpenses($opExpenses),
                'UZS'
            );
            ?>
            <small class="m-0 l-h-n"><?= __d('panel', 'Total expenses') ?></small>
        </h3>
    </div>
    <i class="fal fa-lightbulb position-absolute pos-right pos-bottom opacity-15 mb-n5 mr-n6" style="font-size: 8rem;"></i>
</div>