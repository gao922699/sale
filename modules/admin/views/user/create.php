<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Admin */

$this->title = '添加经销商';
$this->params['breadcrumbs'][] = ['label' => '经销商管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
