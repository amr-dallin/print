<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $laserMachine
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $laserMachine->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $laserMachine->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Laser Machines'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="laserMachines form content">
            <?= $this->Form->create($laserMachine) ?>
            <fieldset>
                <legend><?= __('Edit Laser Machine') ?></legend>
                <?php
                    echo $this->Form->control('type');
                    echo $this->Form->control('title');
                    echo $this->Form->control('description');
                    echo $this->Form->control('date_created');
                    echo $this->Form->control('date_modified', ['empty' => true]);
                    echo $this->Form->control('is_active');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
