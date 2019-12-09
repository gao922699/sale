<?php

use app\models\Admin;
use app\models\Goods;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\gii\GoodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商品管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-index">

    <p>
        <?php
        if (Admin::isAdmin() || Admin::isGoodsAdmin()) {
            echo Html::a('添加商品', ['create'], ['class' => 'btn btn-success']);
        }
        ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'attribute' => 'thumb',
                'format' => [
                    'image',
                    [
                        'height' => 50,
                        'width' => 50,
                    ]
                ],
            ],
            [
                'label' => '分类',
                'value' => function (Goods $model) {
                    return $model->cate->getParentCate()->name . '-' . $model->cate->name;
                }
            ],
            'count',
            [
                'attribute' => 'status',
                'value' => function (Goods $model) {
                    return Goods::$statusMap[$model->status];
                }
            ],
            [
                'label' => '所属供应商',
                'value' => 'admin.username'
            ],
            'updated_at:datetime',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{switch}{offer-history}',
                'visibleButtons' => [
                    'view' => true,
                    'update' => (Admin::isAdmin() || Admin::isGoodsAdmin()),
                    'switch' => (Admin::isAdmin() || Admin::isGoodsAdmin()),
                    'offer-history' => (Admin::isAdmin() || Admin::isSupplier())
                ],
                'buttons' => [
                    'view' => function ($url, Goods $model, $key) {
                        return Html::a('查看', $url, [
                            'class' => 'btn btn-primary btn-xs',
                            'style' => 'margin-left:5px;',
                        ]);
                    },
                    'update' => function ($url, Goods $model, $key) {
                        return Html::a('编辑', $url, [
                            'class' => 'btn btn-warning btn-xs',
                            'style' => 'margin-left:5px;',
                        ]);
                    },
                    'switch' => function ($url, Goods $model, $key) {
                        $text = $model->status == Admin::STATUS_ACTIVE ? '禁用' : '启用';
                        $class = $model->status == Admin::STATUS_ACTIVE ? 'btn btn-danger btn-xs' : 'btn btn-success btn-xs';
                        return Html::a($text, $url, [
                            'class' => $class,
                            'style' => 'margin-left:5px;',
                            'data' => [
                                'confirm' => '确认执行该操作?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                    'offer-history' => function ($url, Goods $model, $key) {
                        return Html::a('报价记录', $url, [
                            'class' => 'btn btn-default btn-xs',
                            'style' => 'margin-left:5px;',
                        ]);
                    }
                ],
            ],
        ],
    ]); ?>


</div>
