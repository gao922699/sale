<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Admin */
/* @var $form yii\widgets\ActiveForm */

$this->title = '修改密码：'.$model->username;
$this->params['breadcrumbs'][] = ['label' => '用户管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$model->password = '';
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'confirmPassword')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('确认修改', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
