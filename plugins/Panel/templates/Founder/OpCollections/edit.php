<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $opCollection
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $opCollection->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $opCollection->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Op Collections'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="opCollections form content">
            <?= $this->Form->create($opCollection) ?>
            <fieldset>
                <legend><?= __('Edit Op Collection') ?></legend>
                <?php
                    echo $this->Form->control('date_from');
                    echo $this->Form->control('date_to');
                    echo $this->Form->control('date_collection', ['empty' => true]);
                    echo $this->Form->control('confirmed');
                    echo $this->Form->control('notes');
                    echo $this->Form->control('date_created');
                    echo $this->Form->control('date_modified', ['empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
