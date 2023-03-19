<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $paperColor
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Paper Color'), ['action' => 'edit', $paperColor->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Paper Color'), ['action' => 'delete', $paperColor->id], ['confirm' => __('Are you sure you want to delete # {0}?', $paperColor->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Paper Colors'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Paper Color'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="paperColors view content">
            <h3><?= h($paperColor->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($paperColor->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($paperColor->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Created') ?></th>
                    <td><?= h($paperColor->date_created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Modified') ?></th>
                    <td><?= h($paperColor->date_modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($paperColor->description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
