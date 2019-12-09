<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\gii\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '首页轮播图管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-index">

    <p>
        <?= Html::a('添加轮播图', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'src',
                'label'=>'图片',
                'format' => [
                    'image',
                    [
                        'height' => 50,
                        'width' => 90,
                    ]
                ],
            ],
            'alt',
            'url:url',
            'order',
            'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
