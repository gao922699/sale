<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\gii\Goods */

$this->title = '更新商品：' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '商品列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="goods-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
