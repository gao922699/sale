<?php

/* @var $this yii\web\View */
/* @var $goodsCount */
/* @var $supplierCount */
/* @var $offerCount */
/* @var $userCount */

$this->title = Yii::$app->name.'-后台';

use yii\helpers\Url; ?>
<div class="site-index">

    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?=$goodsCount?></h3>

                    <p>商品总数</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="<?=Url::toRoute('/admin/goods')?>" class="small-box-footer">更多 <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?=$supplierCount?></h3>

                    <p>供应商总数</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?=Url::toRoute('/admin/admin')?>" class="small-box-footer">更多 <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?=$userCount?></h3>

                    <p>经销商总数</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="<?=Url::toRoute('/admin/user')?>" class="small-box-footer">更多 <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?=$offerCount?></h3>

                    <p>报价单总数</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="<?=Url::toRoute('/admin/offer')?>" class="small-box-footer">更多 <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
</div>
