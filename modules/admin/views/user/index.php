<?php

use app\models\User;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\gii\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '经销商管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="User-index">

    <p>
        <?= Html::a('添加经销商', ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute' => 'status',
                'value' => function (User $model) {
                    return User::$statusTxtMap[$model->status];
                }
            ],
            'updated_at:datetime',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{edit-password}{update}{switch}',
                'buttons' => [
                    'view' => function ($url, User $model, $key) {
                        return Html::a('查看', $url, [
                            'class' => 'btn btn-success btn-xs',
                            'style' => 'margin-left:5px;',
                        ]);
                    },
                    'edit-password' => function ($url, User $model, $key) {
                        return Html::a('修改密码', $url, [
                            'class' => 'btn btn-warning btn-xs',
                            'style' => 'margin-left:5px;',
                        ]);
                    },
                    'update' => function ($url, User $model, $key) {
                        return Html::a('修改信息', $url, [
                            'class' => 'btn btn-primary btn-xs',
                            'style' => 'margin-left:5px;',
                        ]);
                    },
                    'switch' => function ($url, User $model, $key) {
                        $text = $model->status == User::STATUS_ACTIVE ? '禁用' : '启用';
                        $class = $model->status == User::STATUS_ACTIVE ? 'btn btn-danger btn-xs' : 'btn btn-success btn-xs';
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
