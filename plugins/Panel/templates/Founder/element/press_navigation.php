    <ul id="js-nav-menu" class="nav-menu">
        <!-- Dashboard menu -->
        <li class="<?php if (isset($menu['dashboard'])) echo 'active open'; ?>">
            <?php
            echo $this->Html->link(
                $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-chart-area']).
                ' '.
                $this->Html->tag('span', __d('panel', 'Dashboard'),
                    ['class' => 'nav-link-text']
                ),
                ['controller' => 'SystemicPages', 'action' => 'press'],
                ['escape' => false, 'title' => __d('panel', 'Dashboard'), 'data-filter-tags' => __d('panel', 'dashboard')]
            );
            ?>
        </li>

        <!-- Begin orders -->
        <li <?php if (isset($menu['orders'])) echo 'class="active"'; ?>>
            <?php
            echo $this->Html->link(
                $this->Html->tag('i', '', ['class' => 'fa-lg fa-fw fal fa-bags-shopping']) .
                $this->Html->tag(
                    'span',
                    __d('panel', 'Orders'),
                    ['class' => 'nav-link-text']
                ),
                '#',
                ['escape' => false, 'title' => __d('panel', 'Orders'), 'data-filter-tags' => __d('panel', 'orders')]
            );
            ?>
            <ul>
                <li class="<?php if (isset($menu['orders']['create'])) echo 'active open'; ?>">
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('span', __d('panel', 'Create'),
                            ['class' => 'nav-link-text']
                        ),
                        ['controller' => 'Orders', 'action' => 'add'],
                        ['escape' => false, 'title' => __d('panel', 'create order'), 'data-filter-tags' => __d('panel', 'create order')]
                    );
                    ?>
                </li>
                <li class="<?php if (isset($menu['orders']['by_status'])) echo 'active open'; ?>">
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag(
                            'span',
                            __d('panel', 'By status'),
                            ['class' => 'nav-link-text']
                        ),
                        '#',
                        ['escape' => false, 'title' => __d('panel', 'Orders by status'), 'data-filter-tags' => __d('panel', 'orders by status')]
                    );
                    ?>
                    <ul>
                        <li <?php if (isset($menu['orders']['by_status'][$this->Orders->navigationSlug(ORDERS_STATUS_ESTIMATED)])) echo 'class="active"'; ?>>
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag('span', __d('panel', 'Estimated'), ['class' => 'nav-link-text']),
                                ['controller' => 'Orders', 'action' => 'indexEstimated'],
                                ['escape' => false, 'title' => __d('panel', 'Estimated orders'), 'data-filter-tags' => __d('panel', 'Estimated orders')]
                            );
                            ?>
                        </li>

                        <li <?php if (isset($menu['orders']['by_status'][$this->Orders->navigationSlug(ORDERS_STATUS_IN_PROGRESS)])) echo 'class="active"'; ?>>
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag('span', __d('panel', 'In progress'), ['class' => 'nav-link-text']),
                                ['controller' => 'Orders', 'action' => 'indexInProgress'],
                                ['escape' => false, 'title' => __d('panel', 'Orders in progress'), 'data-filter-tags' => __d('panel', 'orders in progress')]
                            );
                            ?>
                        </li>

                        <li <?php if (isset($menu['orders']['by_status'][$this->Orders->navigationSlug(ORDERS_STATUS_STATEMENT_COMPLETED)])) echo 'class="active"'; ?>>
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag('span', __d('panel', 'Statement completed'), ['class' => 'nav-link-text']),
                                ['controller' => 'Orders', 'action' => 'indexStatementCompleted'],
                                ['escape' => false, 'title' => __d('panel', 'Statement completed orders'), 'data-filter-tags' => __d('panel', 'statement completed orders')]
                            );
                            ?>
                        </li>

                        <li <?php if (isset($menu['orders']['by_status'][$this->Orders->navigationSlug(ORDERS_STATUS_COMPLETED)])) echo 'class="active"'; ?>>
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag('span', __d('panel', 'Completed'), ['class' => 'nav-link-text']),
                                ['controller' => 'Orders', 'action' => 'indexCompleted'],
                                ['escape' => false, 'title' => __d('panel', 'Completed orders'), 'data-filter-tags' => __d('panel', 'completed orders')]
                            );
                            ?>
                        </li>

                        <li <?php if (isset($menu['orders']['by_status'][$this->Orders->navigationSlug(ORDERS_STATUS_PROBLEM)])) echo 'class="active"'; ?>>
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag('span', __d('panel', 'Problem'), ['class' => 'nav-link-text']),
                                ['controller' => 'Orders', 'action' => 'indexProblem'],
                                ['escape' => false, 'title' => __d('panel', 'Problem orders'), 'data-filter-tags' => __d('panel', 'problem orders')]
                            );
                            ?>
                        </li>
                    </ul>
                </li>

                <li class="mb-4"></li>

                <li class="<?php if (isset($menu['orders']['clients'])) echo 'active open'; ?>">
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag(
                            'span',
                            __d('panel', 'Clients'),
                            ['class' => 'nav-link-text']
                        ),
                        '#',
                        ['escape' => false, 'title' => __d('panel', 'Clients'), 'data-filter-tags' => __d('panel', 'clients')]
                    );
                    ?>
                    <ul>
                        <li class="<?php if (isset($menu['orders']['clients']['create'])) echo 'active open'; ?>">
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag(
                                    'span',
                                    __d('panel', 'Create'),
                                    ['class' => 'nav-link-text']
                                ),
                                ['controller' => 'Clients', 'action' => 'add'],
                                ['escape' => false, 'title' => __d('panel', 'create client'), 'data-filter-tags' => __d('panel', 'create client')]
                            );
                            ?>
                        </li>
                        <li class="<?php if (isset($menu['orders']['clients']['internal'])) echo 'active open'; ?>">
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag(
                                    'span',
                                    __d('panel', 'Internal'),
                                    ['class' => 'nav-link-text']
                                ),
                                ['controller' => 'Clients', 'action' => 'index', CLIENTS_TYPE_INTERNAL],
                                ['escape' => false, 'title' => __d('panel', 'Internal clients'), 'data-filter-tags' => __d('panel', 'internal clients')]
                            );
                            ?>
                        </li>
                        <li class="<?php if (isset($menu['orders']['clients']['external'])) echo 'active open'; ?>">
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag(
                                    'span',
                                    __d('panel', 'External'),
                                    ['class' => 'nav-link-text']
                                ),
                                ['controller' => 'Clients', 'action' => 'index', CLIENTS_TYPE_EXTERNAL],
                                ['escape' => false, 'title' => __d('panel', 'External clients'), 'data-filter-tags' => __d('panel', 'external clients')]
                            );
                            ?>
                        </li>
                    </ul>
                    
                </li>

                <li <?php if (isset($menu['orders']['contractors'])) echo 'class="active"'; ?>>
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('span', __d('panel', 'Contractors'), ['class' => 'nav-link-text']),
                        ['controller' => 'Contractors', 'action' => 'index'],
                        ['escape' => false, 'title' => __d('panel', 'Contractors'), 'data-filter-tags' => __d('panel', 'contractors')]
                    );
                    ?>
                </li>
            </ul>
        </li>
        <!-- End orders -->

        <!-- Begin storage -->
        <li <?php if (isset($menu['storage'])) echo 'class="active"'; ?>>
            <?php
            echo $this->Html->link(
                $this->Html->tag('i', '', ['class' => 'fa-lg fa-fw far fa-cabinet-filing']) .
                $this->Html->tag(
                    'span',
                    __d('panel', 'Storage'),
                    ['class' => 'nav-link-text']
                ),
                '#',
                ['escape' => false, 'title' => __d('panel', 'Storage'), 'data-filter-tags' => __d('panel', 'storage')]
            );
            ?>
            <ul>
                <li class="<?php if (isset($menu['storage']['availability'])) echo 'active open'; ?>">
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag(
                            'span',
                            __d('panel', 'Availability'),
                            ['class' => 'nav-link-text']
                        ),
                        '#',
                        ['escape' => false, 'title' => __d('panel', 'Availability'), 'data-filter-tags' => __d('panel', 'availability')]
                    );
                    ?>
                    <ul>
                        <li class="<?php if (isset($menu['storage']['availability']['papers'])) echo 'active open'; ?>">
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag(
                                    'span',
                                    __d('panel', 'Papers'),
                                    ['class' => 'nav-link-text']
                                ),
                                ['controller' => 'Storage', 'action' => 'availabilityPapers'],
                                ['escape' => false, 'title' => __d('panel', 'Availability papers'), 'data-filter-tags' => __d('panel', 'availability papers')]
                            );
                            ?>
                        </li>
                        <li class="<?php if (isset($menu['storage']['availability']['consumables'])) echo 'active open'; ?>">
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag(
                                    'span',
                                    __d('panel', 'Consumables'),
                                    ['class' => 'nav-link-text']
                                ),
                                ['controller' => 'Storage', 'action' => 'availabilityConsumables'],
                                ['escape' => false, 'title' => __d('panel', 'Availability consumables'), 'data-filter-tags' => __d('panel', 'availability consumables')]
                            );
                            ?>
                        </li>
                    </ul>
                    
                </li>

                <li class="<?php if (isset($menu['storage']['expenses'])) echo 'active open'; ?>">
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag(
                            'span',
                            __d('panel', 'Expenses'),
                            ['class' => 'nav-link-text']
                        ),
                        ['controller' => 'Expenses', 'action' => 'index'],
                        ['escape' => false, 'title' => __d('panel', 'Expenses'), 'data-filter-tags' => __d('panel', 'expenses')]
                    );
                    ?>
                </li>

                <li class="<?php if (isset($menu['storage']['purchases'])) echo 'active open'; ?>">
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag(
                            'span',
                            __d('panel', 'Purchases'),
                            ['class' => 'nav-link-text']
                        ),
                        ['controller' => 'Purchases', 'action' => 'index'],
                        ['escape' => false, 'title' => __d('panel', 'Purchases'), 'data-filter-tags' => __d('panel', 'purchases')]
                    );
                    ?>
                </li>

                <li class="<?php if (isset($menu['storage']['suppliers'])) echo 'active open'; ?>">
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag(
                            'span',
                            __d('panel', 'Suppliers'),
                            ['class' => 'nav-link-text']
                        ),
                        ['controller' => 'Suppliers', 'action' => 'index'],
                        ['escape' => false, 'title' => __d('panel', 'Suppliers'), 'data-filter-tags' => __d('panel', 'suppliers')]
                    );
                    ?>
                </li>
            </ul>
        </li>
        <!-- End storage -->

        <!-- Begin directory -->
        <li <?php if (isset($menu['directory'])) echo 'class="active"'; ?>>
            <?php
            echo $this->Html->link(
                $this->Html->tag('i', '', ['class' => 'fa-lg fa-fw far fa-folder']) .
                $this->Html->tag(
                    'span',
                    __d('panel', 'Directory'),
                    ['class' => 'nav-link-text']
                ),
                '#',
                ['escape' => false, 'title' => __d('panel', 'Directory'), 'data-filter-tags' => __d('panel', 'directory')]
            );
            ?>
            <ul>
                <li class="<?php if (isset($menu['directory']['paper'])) echo 'active open'; ?>">
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag(
                            'span',
                            __d('panel', 'Paper'),
                            ['class' => 'nav-link-text']
                        ),
                        '#',
                        ['escape' => false, 'title' => __d('panel', 'Directory paper'), 'data-filter-tags' => __d('panel', 'directory paper')]
                    );
                    ?>
                    <ul>
                        <li <?php if (isset($menu['directory']['paper']['assortment'])) echo 'class="active"'; ?>>
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag(
                                    'span',
                                    __d('panel', 'Assortment'),
                                    ['class' => 'nav-link-text']
                                ),
                                ['controller' => 'Papers', 'action' => 'index'],
                                ['escape' => false, 'title' => __d('panel', 'Paper assortment'), 'data-filter-tags' => __d('panel', 'paper assortment')]
                            );
                            ?>
                        </li>
                        <li <?php if (isset($menu['directory']['paper']['types'])) echo 'class="active"'; ?>>
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag(
                                    'span',
                                    __d('panel', 'Types'),
                                    ['class' => 'nav-link-text']
                                ),
                                ['controller' => 'PaperTypes', 'action' => 'index'],
                                ['escape' => false, 'title' => __d('panel', 'Paper types'), 'data-filter-tags' => __d('panel', 'paper types')]
                            );
                            ?>
                        </li>
                        <li <?php if (isset($menu['directory']['paper']['densities'])) echo 'class="active"'; ?>>
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag(
                                    'span',
                                    __d('panel', 'Densities'),
                                    ['class' => 'nav-link-text']
                                ),
                                ['controller' => 'PaperDensities', 'action' => 'index'],
                                ['escape' => false, 'title' => __d('panel', 'Paper densities'), 'data-filter-tags' => __d('panel', 'paper densities')]
                            );
                            ?>
                        </li>
                        <li <?php if (isset($menu['directory']['paper']['formats'])) echo 'class="active"'; ?>>
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag(
                                    'span',
                                    __d('panel', 'Formats'),
                                    ['class' => 'nav-link-text']
                                ),
                                ['controller' => 'PaperFormats', 'action' => 'index'],
                                ['escape' => false, 'title' => __d('panel', 'Paper formats'), 'data-filter-tags' => __d('panel', 'paper formats')]
                            );
                            ?>
                        </li>
                        <li <?php if (isset($menu['directory']['paper']['colors'])) echo 'class="active"'; ?>>
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag(
                                    'span',
                                    __d('panel', 'Colors'),
                                    ['class' => 'nav-link-text']
                                ),
                                ['controller' => 'PaperColors', 'action' => 'index'],
                                ['escape' => false, 'title' => __d('panel', 'Paper colors'), 'data-filter-tags' => __d('panel', 'paper colors')]
                            );
                            ?>
                        </li>
                    </ul>
                </li>

                <li class="<?php if (isset($menu['directory']['consumables'])) echo 'active open'; ?>">
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag(
                            'span',
                            __d('panel', 'Consumables'),
                            ['class' => 'nav-link-text']
                        ),
                        '#',
                        ['escape' => false, 'title' => __d('panel', 'Directory consumables'), 'data-filter-tags' => __d('panel', 'directory consumables')]
                    );
                    ?>
                    <ul>
                        <li <?php if (isset($menu['directory']['consumables']['assortment'])) echo 'class="active"'; ?>>
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag(
                                    'span',
                                    __d('panel', 'Assortment'),
                                    ['class' => 'nav-link-text']
                                ),
                                ['controller' => 'Consumables', 'action' => 'index'],
                                ['escape' => false, 'title' => __d('panel', 'Consumables assortment'), 'data-filter-tags' => __d('panel', 'consumables assortment')]
                            );
                            ?>
                        </li>
                        <li <?php if (isset($menu['directory']['consumables']['categories'])) echo 'class="active"'; ?>>
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag(
                                    'span',
                                    __d('panel', 'Categories'),
                                    ['class' => 'nav-link-text']
                                ),
                                ['controller' => 'ConsumableCategories', 'action' => 'index'],
                                ['escape' => false, 'title' => __d('panel', 'Consumable categories'), 'data-filter-tags' => __d('panel', 'consumable categories')]
                            );
                            ?>
                        </li>
                    </ul>
                </li>

                <li class="<?php if (isset($menu['directory']['printing_machines'])) echo 'active open'; ?>">
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag(
                            'span',
                            __d('panel', 'Printing machines'),
                            ['class' => 'nav-link-text']
                        ),
                        '#',
                        ['escape' => false, 'title' => __d('panel', 'Directory printing machines'), 'data-filter-tags' => __d('panel', 'directory printing machines')]
                    );
                    ?>
                    <ul>
                        <li <?php if (isset($menu['directory']['printing_machines']['laser_machines'])) echo 'class="active"'; ?>>
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag(
                                    'span',
                                    __d('panel', 'Laser machines'),
                                    ['class' => 'nav-link-text']
                                ),
                                ['controller' => 'LaserMachines', 'action' => 'index'],
                                ['escape' => false, 'title' => __d('panel', 'Laser machines'), 'data-filter-tags' => __d('panel', 'laser machines')]
                            );
                            ?>
                        </li>
                    </ul>
                </li>

                <li <?php if (isset($menu['directory']['actions'])) echo 'class="active"'; ?>>
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('span', __d('panel', 'Actions'), ['class' => 'nav-link-text']),
                        ['controller' => 'Actions', 'action' => 'index'],
                        ['escape' => false, 'title' => __d('panel', 'Actions'), 'data-filter-tags' => __d('panel', 'actions')]
                    );
                    ?>
                </li>

                <li <?php if (isset($menu['directory']['product_types'])) echo 'class="active"'; ?>>
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('span', __d('panel', 'Product types'), ['class' => 'nav-link-text']),
                        ['controller' => 'ProductTypes', 'action' => 'index'],
                        ['escape' => false, 'title' => __d('panel', 'Product types'), 'data-filter-tags' => __d('panel', 'product types')]
                    );
                    ?>
                </li>

                <li <?php if (isset($menu['directory']['units'])) echo 'class="active"'; ?>>
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('span', __d('panel', 'Measurement units'), ['class' => 'nav-link-text']),
                        ['controller' => 'Units', 'action' => 'index'],
                        ['escape' => false, 'title' => __d('panel', 'Measurement units'), 'data-filter-tags' => __d('panel', 'measurement units')]
                    );
                    ?>
                </li>
            </ul>
        </li>
        <!-- End directory -->

    </ul>
