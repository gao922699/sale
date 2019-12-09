<?php

use app\models\Admin;
use app\models\Goods;
use app\models\OfferGoods;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '报价记录';
$this->params['breadcrumbs'][] = ['label' => '商品列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="goods-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => '经销商',
                'value' => function (OfferGoods $model) {
                    return $model->offer->user->username;
                }
            ],
            [
                'attribute' => 'offer_price',
                'value' => function (OfferGoods $model) {
                    return Admin::isAdmin() ? $model->offer_price : '无权查看';
                }
            ],
            [
                'attribute' => 'cost_price',
                'value' => function (OfferGoods $model) {
                    return Admin::isAdmin() ? $model->cost_price : '无权查看';
                }
            ],
            'created_at:datetime'
        ],
    ]); ?>


</div>
