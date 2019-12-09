<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\gii\Cate */

$this->title = '新建分类';
$this->params['breadcrumbs'][] = ['label' => '分类管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cate-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
