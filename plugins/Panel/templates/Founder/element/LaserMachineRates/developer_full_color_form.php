<div class="row">
    <div class="col-lg-3 mb-3">
        <?php
        echo $this->Form->control('developer_c_p', [
            'label' => __d('panel', 'Cyan') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
            'required' => true,
            'escape' => false,
        ]);
        ?>
    </div>
    <div class="col-lg-3 mb-3">
        <?php
        echo $this->Form->control('developer_m_p', [
            'label' => __d('panel', 'Magento') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
            'required' => true,
            'escape' => false,
        ]);
        ?>
    </div>
    <div class="col-lg-3 mb-3">
        <?php
        echo $this->Form->control('developer_y_p', [
            'label' => __d('panel', 'Yellow') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
            'required' => true,
            'escape' => false,
        ]);
        ?>
    </div>
    <div class="col-lg-3 mb-3">
        <?php
        echo $this->Form->control('developer_k_p', [
            'label' => __d('panel', 'Black') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
            'escape' => false,
        ]);
        ?>
    </div>
</div>