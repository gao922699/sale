<?php

use app\models\Goods;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Goods */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '商品列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="goods-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'thumb',
                'format' => [
                    'image', ['height' => 70, 'width' => 70]
                ]
            ],
            'abstract',
            [
                'attribute' => 'carousel',
                'format' => 'raw',
                'value' => $model->getCarouselHtml(),
            ],
            'detail:raw',
            [
                'label' => '分类',
                'value' => $model->cate->getParentCate()->name . '-' . $model->cate->name
            ],
            'type',
            'brand',
            'price',
            'count',
            [
                'attribute' => 'status',
                'value' => Goods::$statusMap[$model->status],
            ],
            'admin.username',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>

<style>
    .preview {
        width: 300px;
        height: auto;
        margin-left: 10px;
    }
</style>
