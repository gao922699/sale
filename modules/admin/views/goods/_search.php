<?php

use app\models\Admin;
use app\models\Cate;
use app\models\Goods;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\gii\GoodsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'id') ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'name') ?>
        </div>
        <div class="col-md-2">
            <?php
            echo $form->field($model, 'cate_id')->widget(Select2::class, [
                'data' => Cate::getCateTree(),
                'language' => 'zh-cn',
                'options' => ['placeholder' => '请选择分类'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'brand') ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'admin_id')->dropDownList(Admin::getSuppliers(), ['prompt' => '未选择']) ?>
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
