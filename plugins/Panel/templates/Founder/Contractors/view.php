<?php
/**$contractor
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $contractor
 */
$this->assign('title', h($contractor->title));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Orders')],
    ['title' => __d('panel', 'Contractors'), 'url' => ['action' => 'index']],
    ['title' => h($contractor->title)]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['orders']['contractors'] = true;
echo $this->element('press_navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css([
    'datagrid/datatables/datatables.bundle'
], ['block' => true]);

echo $this->Html->script([
    'datagrid/datatables/datatables.bundle'
], ['block' => true]);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function() {

});
</script>
<?php $this->end(); ?>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'General') ?></h2>
                <div class="panel-toolbar ml-auto mr-3">
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('i', '', ['class' => 'fal fa-pencil mr-1']) . __d('panel', 'Edit'),
                        ['action' => 'edit', h($contractor->id)],
                        ['class' => 'btn btn-xs btn-warning', 'escape' => false]
                    );
                    ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="row">
                        <div class="col-md-8">
                            <h1 class="mb-3"><?= h($contractor->title) ?></h1>
                            <dl class="row fs-xl">                                
                                <?php if (!empty($contractor->description)): ?>
                                <dt class="col-md-3 col-lg-2"><?= __d('panel', 'Description') ?></dt>
                                <dd class="col-md-9 col-lg-10"><?= h($contractor->description) ?></dd>
                                <?php endif; ?>
                            </dl>
                        </div>
                        <div class="col-md-4">
                            <div class="card shadow-none">
                                <div class="card-header bg-warning-50 py-1">
                                    <div class="card-title"><?= __d('panel', 'Representatives') ?></div>
                                </div>
                                <div class="card-body">
                                    <dl class="row fs-lg mb-0">
                                        <dt class="col-md-5"><?= __d('panel', 'First name') ?></dt>
                                        <dd class="col-md-7"><?= h($contractor->representative->first_name) ?></dd>

                                        <?php if (!empty($contractor->representative->second_name)): ?>
                                        <dt class="col-md-5"><?= __d('panel', 'Second name') ?></dt>
                                        <dd class="col-md-7"><?= h($contractor->representative->second_name) ?></dd>
                                        <?php endif; ?>

                                        <?php if (!empty($contractor->representative->sur_name)): ?>
                                        <dt class="col-md-5"><?= __d('panel', 'Surname') ?></dt>
                                        <dd class="col-md-7"><?= h($contractor->representative->sur_name) ?></dd>
                                        <?php endif; ?>
                                    </dl>
                                    <hr/>
                                    <dl class="row fs-lg mb-0">
                                        <dt class="col-md-5"><?= __d('panel', 'Phone number') ?></dt>
                                        <dd class="col-md-7">
                                            <?php
                                            echo $this->Html->link(
                                                $contractor->representative->phone_number->full_number,
                                                'tel:' . $contractor->representative->phone_number->full_number
                                            );
                                            ?>
                                        </dd>
                                        <?php if ($this->PhoneNumbers->isTelegram($contractor->representative->phone_number->is_telegram)): ?>
                                        <dt class="col-md-5"><?= __d('panel', 'Telegram') ?></dt>
                                        <dd class="col-md-7">
                                            <?php
                                            echo $this->Html->link(
                                                $this->Html->tag('i', '', ['class' => 'fab fa-telegram']),
                                                'https://t.me/' . $contractor->representative->phone_number->full_number,
                                                ['target' => '_blank', 'escape' => false, 'class' => 'fs-xxl']
                                            );
                                            ?>
                                        </dd>
                                        <?php endif; ?>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>