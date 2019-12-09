<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\gii\CateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '分类管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cate-index">

    <p>
        <?= Html::a('新增分类', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'attribute' => 'photo',
                'format' => [
                    'image',
                    [
                        'height' => 50,
                        'width' => 50,
                    ]
                ],
            ],
            [
                'attribute' => 'parent_id',
                'label' => '父级分类',
                'value' => function (\app\models\Cate $model) {
                    return $model->getParentCate()->name;
                }
            ],
            'order',
            'created_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
