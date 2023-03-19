<div class="row">
    <div class="col mb-3">
        <?php
        echo $this->Form->control('developer_k_p', [
            'label' => __d('panel', 'Black') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
            'escape' => false,
        ]);
        ?>
    </div>
</div>