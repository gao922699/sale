<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cate */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '分类管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cate-view">

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确认删除该分类？',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute'=>'photo',
                'format'=>[
                    'image',['height'=>200,'width'=>200]
                ]
            ],
            [
                    'attribute'=>'parent_id',
                'label'=>'父级分类',
                'value'=>$model->getParentCate()->name,
            ],
            'order',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
