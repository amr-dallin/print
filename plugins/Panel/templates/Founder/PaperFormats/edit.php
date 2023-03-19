<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $paperFormat
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $paperFormat->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $paperFormat->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Paper Formats'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="paperFormats form content">
            <?= $this->Form->create($paperFormat) ?>
            <fieldset>
                <legend><?= __('Edit Paper Format') ?></legend>
                <?php
                    echo $this->Form->control('width');
                    echo $this->Form->control('height');
                    echo $this->Form->control('description');
                    echo $this->Form->control('date_created');
                    echo $this->Form->control('date_modified', ['empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
