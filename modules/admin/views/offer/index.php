<?php

use app\models\Offer;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\gii\OfferSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '报价单管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offer-index">

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'label' => '经销商',
                'value' => 'user.username'
            ],
            'name',
            'tel',
            'date:date',
            'created_at:datetime',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, Offer $model, $key) {
                        return Html::a('查看明细', $url, [
                            'class' => 'btn btn-primary btn-xs',
                            'style' => 'margin-left:5px;',
                        ]);
                    }
                ],
            ],
        ],
    ]); ?>


</div>
