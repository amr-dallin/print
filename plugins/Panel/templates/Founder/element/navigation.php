    <ul id="js-nav-menu" class="nav-menu">

        <li <?php if (isset($menu['op'])) echo 'class="active"'; ?>>
            <?php
            echo $this->Html->link(
                $this->Html->tag('i', '', ['class' => 'fa-lg fa-fw far fa-concierge-bell']) .
                $this->Html->tag(
                    'span',
                    __d('panel', 'Operational printing'),
                    ['class' => 'nav-link-text']
                ),
                '#',
                ['escape' => false, 'title' => __d('panel', 'Operational printing'), 'data-filter-tags' => __d('panel', 'operational printing')]
            );
            ?>
            <ul>
                <!-- Begin operational printing services -->
                <li class="<?php if (isset($menu['op']['services'])) echo 'active open'; ?>">
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag(
                            'span',
                            __d('panel', 'Services'),
                            ['class' => 'nav-link-text']
                        ),
                        '#',
                        ['escape' => false, 'title' => __d('panel', 'Operational printing services'), 'data-filter-tags' => __d('panel', 'operational printing services')]
                    );
                    ?>
                    <ul>
                        <li <?php if (isset($menu['op']['services'][0])) echo 'class="active"'; ?>>
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag(
                                    'span',
                                    __d('panel', 'Create'),
                                    ['class' => 'nav-link-text']
                                ),
                                ['controller' => 'OpServices', 'action' => 'add'],
                                ['escape' => false, 'title' => __d('panel', 'Create operational printing services'), 'data-filter-tags' => __d('panel', 'create operational printing services')]
                            );
                            ?>
                        </li>
                        <li <?php if (isset($menu['op']['services'][1])) echo 'class="active"'; ?>>
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag(
                                    'span',
                                    __d('panel', 'List'),
                                    ['class' => 'nav-link-text']
                                ),
                                ['controller' => 'OpServices', 'action' => 'index'],
                                ['escape' => false, 'title' => __d('panel', 'List operational printing services'), 'data-filter-tags' => __d('panel', 'list operational printing services')]
                            );
                            ?>
                        </li>
                        <li <?php if (isset($menu['op']['services'][2])) echo 'class="active"'; ?>>
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag(
                                    'span',
                                    __d('panel', 'Analitics'),
                                    ['class' => 'nav-link-text']
                                ),
                                ['controller' => 'OpServices', 'action' => 'analitics'],
                                ['escape' => false, 'title' => __d('panel', 'Create operational printing services analitics'), 'data-filter-tags' => __d('panel', 'create operational printing services analitics')]
                            );
                            ?>
                        </li>
                    </ul>
                </li>
                <!-- End operational printing services -->

                <!-- Begin operational printing collections -->
                <li class="<?php if (isset($menu['op']['collections'])) echo 'active open'; ?>">
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag(
                            'span',
                            __d('panel', 'Collections'),
                            ['class' => 'nav-link-text']
                        ),
                        '#',
                        ['escape' => false, 'title' => __d('panel', 'Operational printing collections'), 'data-filter-tags' => __d('panel', 'operational printing collections')]
                    );
                    ?>
                    <ul>
                        <li <?php if (isset($menu['op']['collections'][0])) echo 'class="active"'; ?>>
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag(
                                    'span',
                                    __d('panel', 'Create'),
                                    ['class' => 'nav-link-text']
                                ),
                                ['controller' => 'OpCollections', 'action' => 'add'],
                                ['escape' => false, 'title' => __d('panel', 'Create operational printing collections'), 'data-filter-tags' => __d('panel', 'create operational printing collections')]
                            );
                            ?>
                        </li>
                        <li <?php if (isset($menu['op']['collections'][1])) echo 'class="active"'; ?>>
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag(
                                    'span',
                                    __d('panel', 'List'),
                                    ['class' => 'nav-link-text']
                                ),
                                ['controller' => 'OpCollections', 'action' => 'index'],
                                ['escape' => false, 'title' => __d('panel', 'List operational printing collections'), 'data-filter-tags' => __d('panel', 'list operational printing collections')]
                            );
                            ?>
                        </li>
                    </ul>
                </li>
                <!-- End operational printing collections -->
            </ul>
        </li>
    
        <li <?php if (isset($menu['cash_register'])) echo 'class="active"'; ?>>
            <?php
            echo $this->Html->link(
                $this->Html->tag('i', '', ['class' => 'fa-lg fa-fw fal fa-cash-register']) .
                    $this->Html->tag('span', __d('panel', 'Cash register'), ['class' => 'nav-link-text']),
                '#',
                [
                    'escape' => false,
                    'title' => __d('panel', 'Cash register'),
                    'data-filter-tags' => __d('panel', 'cash register')
                ]
            );
            ?>
            <ul>
                <li <?php if (isset($menu['cash_register']['statistics'])) echo 'class="active"'; ?>>
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('span', __d('panel', 'Statistics'), ['class' => 'nav-link-text']),
                            ['controller' => 'SystemicPages', 'action' => 'cashRegisterStatistics'],
                            [
                                'escape' => false,
                                'title' => __d('panel', 'Cash register statistics'),
                                'data-filter-tags' => __d('panel', 'cash register statistics')
                            ]
                        );
                    ?>
                </li>
                <li <?php if (isset($menu['cash_register']['expenses'])) echo 'class="active"'; ?>>
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('span', __d('panel', 'Expenses'), ['class' => 'nav-link-text']),
                            ['controller' => 'Expenses', 'action' => 'index'],
                            [
                                'escape' => false,
                                'title' => __d('panel', 'Cash register expenses'),
                                'data-filter-tags' => __d('panel', 'cash register expenses')
                            ]
                        );
                    ?>
                </li>
                <li <?php if (isset($menu['cash_register']['receipts'])) echo 'class="active"'; ?>>
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('span', __d('panel', 'Receipts'), ['class' => 'nav-link-text']),
                            ['controller' => 'Receipts', 'action' => 'index'],
                            [
                                'escape' => false,
                                'title' => __d('panel', 'Cash register receipts'),
                                'data-filter-tags' => __d('panel', 'cash register receipts')
                            ]
                        );
                    ?>
                </li>
            </ul>
        </li>

    </ul>
