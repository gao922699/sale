<?php

use app\models\Admin;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\gii\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '后台用户管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-index">

    <p>
        <?= Html::a('添加后台用户', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'province',
            'city',
            'contact',
            [
                'attribute' => 'role',
                'value' => function (Admin $model) {
                    return Admin::$roleTxtMap[$model->role];
                }
            ],
            [
                'attribute' => 'status',
                'value' => function (Admin $model) {
                    return Admin::$statusTxtMap[$model->status];
                }
            ],
            'updated_at:datetime',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{edit-password}{update}{switch}',
                'buttons' => [
                    'view' => function ($url, Admin $model, $key) {
                        return Html::a('查看', $url, [
                            'class' => 'btn btn-success btn-xs',
                            'style' => 'margin-left:5px;',
                        ]);
                    },
                    'edit-password' => function ($url, Admin $model, $key) {
                        return Html::a('修改密码', $url, [
                            'class' => 'btn btn-warning btn-xs',
                            'style' => 'margin-left:5px;',
                        ]);
                    },
                    'update' => function ($url, Admin $model, $key) {
                        return Html::a('修改信息', $url, [
                            'class' => 'btn btn-primary btn-xs',
                            'style' => 'margin-left:5px;',
                        ]);
                    },
                    'switch' => function ($url, Admin $model, $key) {
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
                ],
            ],
        ],
    ]); ?>


</div>
