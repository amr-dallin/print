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
            <?= $this->Html->link(__('Edit Paper Format'), ['action' => 'edit', $paperFormat->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Paper Format'), ['action' => 'delete', $paperFormat->id], ['confirm' => __('Are you sure you want to delete # {0}?', $paperFormat->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Paper Formats'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Paper Format'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="paperFormats view content">
            <h3><?= h($paperFormat->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($paperFormat->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Width') ?></th>
                    <td><?= $this->Number->format($paperFormat->width) ?></td>
                </tr>
                <tr>
                    <th><?= __('Height') ?></th>
                    <td><?= $this->Number->format($paperFormat->height) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Created') ?></th>
                    <td><?= h($paperFormat->date_created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Modified') ?></th>
                    <td><?= h($paperFormat->date_modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($paperFormat->description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
