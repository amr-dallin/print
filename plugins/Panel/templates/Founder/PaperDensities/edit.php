<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $paperDensity
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $paperDensity->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $paperDensity->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Paper Densities'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="paperDensities form content">
            <?= $this->Form->create($paperDensity) ?>
            <fieldset>
                <legend><?= __('Edit Paper Density') ?></legend>
                <?php
                    echo $this->Form->control('density');
                    echo $this->Form->control('date_created');
                    echo $this->Form->control('date_modified', ['empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
