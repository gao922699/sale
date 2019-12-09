<?php

/* @var $this yii\web\View */
/* @var $goodsCount */
/* @var $cateCount */

$this->title = Yii::$app->name.'-后台';

use yii\helpers\Url; ?>
<div class="site-index">

    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?=$cateCount?></h3>

                    <p>分类总数</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="<?=Url::toRoute('/admin/cate')?>" class="small-box-footer">更多 <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?=$goodsCount?></h3>

                    <p>商品总数</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?=Url::toRoute('/admin/goods')?>" class="small-box-footer">更多 <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
</div>
