<?php

use app\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\gii\AdminSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'username') ?>
        </div>
        <div class="col-md-1">
            <?= $form->field($model, 'province') ?>
        </div>
        <div class="col-md-1">
            <?= $form->field($model, 'city') ?>
        </div>
        <div class="col-md-1">
            <?= $form->field($model, 'contact') ?>
        </div>
        <div class="col-md-1">
            <?php echo $form->field($model, 'status')->dropDownList(User::$statusTxtMap, ['prompt' => '未选择']) ?>
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
