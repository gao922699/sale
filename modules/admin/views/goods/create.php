<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\gii\Goods */

$this->title = '添加商品';
$this->params['breadcrumbs'][] = ['label' => '商品列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
