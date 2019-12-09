<?php

use app\models\Admin;

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    [
                        'label' => '菜单',
                        'options' => ['class' => 'header']
                    ],
                    [
                        'label' => '首页轮播管理',
                        'icon' => 'circle-o',
                        'visible' => (Admin::isAdmin() || Admin::isGoodsAdmin()),
                        'url' => ['/admin/banner']
                    ],
                    [
                        'label' => '分类管理',
                        'icon' => 'circle-o',
                        'visible' => (Admin::isAdmin() || Admin::isGoodsAdmin()),
                        'url' => ['/admin/cate']
                    ],
                    [
                        'label' => '商品管理',
                        'icon' => 'circle-o',
                        'url' => ['/admin/goods']
                    ],
                    [
                        'label' => '报价单管理',
                        'icon' => 'circle-o',
                        'visible' => Admin::isAdmin(),
                        'url' => ['/admin/offer']
                    ],
                    [
                        'label' => '后台用户管理',
                        'icon' => 'circle-o',
                        'visible' => Admin::isAdmin(),
                        'url' => ['/admin/admin']
                    ],
                    [
                        'label' => '经销商管理',
                        'icon' => 'circle-o',
                        'visible' => Admin::isAdmin(),
                        'url' => ['/admin/user']
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
