<?php

use yii\helpers\Html;
use yii\web\View;

/* @var $this yii\web\View */

$this->title = Yii::$app->name . '-修改税率';
?>
<?= Html::cssFile('/css/editTax.css', ['position' => View::POS_HEAD]) ?>
    <div class="index clearfix">
        <div class="nav">
            <van-nav-bar
                title="修改税率"
                left-text="返回"
                left-arrow
                @click-left="onClickLeft"
            />
        </div>
        <div class="cont clearfix">
            <div class="info">
                <div class="infoName">{{username}}</div>
            </div>
            <div class="item clearfix">
                <div class="itemLeft clearfix">税率：</div>
                <div class="itemRight">
                    <input type="text" v-model="tax" placeholder="请输入0-1的两位小数,如0.17"/>
                </div>
            </div>
            <div class="itemBtn clearfix">
                <van-button type="primary" class="btn" @click="editTax">确认修改</van-button>
            </div>
        </div>
        <van-tabbar v-model="active">
            <van-tabbar-item icon="home-o" url="/">首页</van-tabbar-item>
            <van-tabbar-item icon="search" url="/goods">搜索</van-tabbar-item>
            <van-tabbar-item icon="shopping-cart-o" :info="cartNum" url="/offer/cart-list">待报价</van-tabbar-item>
            <van-tabbar-item icon="manager-o" url="/user">个人中心</van-tabbar-item>
        </van-tabbar>
    </div>
<?= Html::jsFile('/js/editTax.js') ?>