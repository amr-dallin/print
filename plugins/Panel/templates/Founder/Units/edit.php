<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $unit
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $unit->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $unit->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Units'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="units form content">
            <?= $this->Form->create($unit) ?>
            <fieldset>
                <legend><?= __('Edit Unit') ?></legend>
                <?php
                    echo $this->Form->control('title');
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
