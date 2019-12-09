<?php

use yii\helpers\Html;
use yii\web\View;

/* @var $this yii\web\View */

$this->title = Yii::$app->name . '-我的报价单';
?>
<?= Html::cssFile('/css/quotation.css', ['position' => View::POS_HEAD]) ?>
<div class="index clearfix">
    <div class="nav">
        <van-nav-bar
                title="我的报价单"
                left-text="返回"
                left-arrow
                @click-left="onClickLeft"
        />
    </div>
    <div class="cont clearfix">
        <van-list
                v-model="loading"
                :finished="finished"
                finished-text="没有更多了"
                @load="getList"
        >
            <van-panel
                    v-for="(item,index) in offers"
                    :key="item.id"
                    :title="item.name"
                    :desc="item.tel"
                    :status="item.date"
            >
                <div>共 {{item.offerGoods.length}} 种商品</div>
                <div slot="footer">
                    <van-button size="small" type="primary" @click="detail(item.id)">查看详情</van-button>
                </div>
            </van-panel>
        </van-list>
    </div>
    <van-tabbar v-model="active">
        <van-tabbar-item icon="home-o" url="/">首页</van-tabbar-item>
        <van-tabbar-item icon="search" url="/goods">搜索</van-tabbar-item>
        <van-tabbar-item icon="shopping-cart-o" :info="cartNum" url="/offer/cart-list">待报价</van-tabbar-item>
        <van-tabbar-item icon="manager-o" url="/user">个人中心</van-tabbar-item>
    </van-tabbar>
</div>
<?= Html::jsFile('/js/quotation.js') ?>
