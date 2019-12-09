<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Admin */

$this->title = '更新用户信息：' . $model->username;
$this->params['breadcrumbs'][] = ['label' => '经销商管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="admin-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
