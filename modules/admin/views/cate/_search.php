<?php

use app\models\Cate;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\gii\CateSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cate-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'name') ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'parent_id')->dropDownList(Cate::getTopCates(), ['prompt' => '未选择'])->label('父级分类') ?>
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
