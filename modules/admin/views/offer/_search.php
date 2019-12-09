<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\gii\OfferSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="offer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
<div class="row">
    <div class="col-md-2">
        <?= $form->field($model, 'username')->label('经销商') ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'name') ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'tel') ?>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('重置', ['class' => 'btn btn-outline-secondary']) ?>
        </div>
    </div>
</div>

    <?php ActiveForm::end(); ?>

</div>
