<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $laserMachineRate
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Laser Machine Rates'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="laserMachineRates form content">
            <?= $this->Form->create($laserMachineRate) ?>
            <fieldset>
                <legend><?= __('Add Laser Machine Rate') ?></legend>
                <?php
                    echo $this->Form->control('laser_machine_id');
                    echo $this->Form->control('default_pouring');
                    echo $this->Form->control('default_size');
                    echo $this->Form->control('toner_c_p');
                    echo $this->Form->control('toner_m_p');
                    echo $this->Form->control('toner_y_p');
                    echo $this->Form->control('toner_k_p');
                    echo $this->Form->control('drum_c_p');
                    echo $this->Form->control('drum_m_p');
                    echo $this->Form->control('drum_y_p');
                    echo $this->Form->control('drum_k_p');
                    echo $this->Form->control('developer_c_p');
                    echo $this->Form->control('developer_m_p');
                    echo $this->Form->control('developer_y_p');
                    echo $this->Form->control('developer_k_p');
                    echo $this->Form->control('extra');
                    echo $this->Form->control('is_current');
                    echo $this->Form->control('date_commited');
                    echo $this->Form->control('date_created');
                    echo $this->Form->control('date_modified', ['empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
