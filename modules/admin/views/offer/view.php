<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Offer */

$this->title = '查看报价单：' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '报价单管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="offer-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label' => '经销商',
                'value' => $model->user->username,
            ],
            'name',
            'tel',
            'address',
            [
                'label' => '商品详情',
                'format' => 'raw',
                'value' => $model->getGoodsHtml()
            ],
            'date:date',
            'created_at:datetime',
        ],
    ]) ?>

</div>
