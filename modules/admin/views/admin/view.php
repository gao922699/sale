<?php

use app\models\Admin;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Admin */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '后台用户管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="admin-view">

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            [
                'attribute' => 'role',
                'value' => Admin::$roleTxtMap[$model->role]
            ],
            [
                'attribute' => 'status',
                'value' => Admin::$statusTxtMap[$model->status]
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
