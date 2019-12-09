<?php

use yii\helpers\Html;
use yii\web\View;

/* @var $this yii\web\View */

$this->title = Yii::$app->name . '-个人中心';
?>
<?= Html::cssFile('/css/center.css', ['position' => View::POS_HEAD]) ?>
    <div class="index clearfix">
        <div class="nav">
            <van-nav-bar
                    title="个人中心"
                    left-text="返回"
                    left-arrow
                    @click-left="onClickLeft"
            />
        </div>
        <div class="cont clearfix">
            <div class="info">
                <div class="infoName">{{username}}</div>
            </div>
            <div class="list">
                <a href="/user/favorite-list" class="sc">我的收藏</a>
                <a href="/user/offer-list" class="bjd">报价记录单</a>
            </div>
            <div class="loginOut">
                <van-button type="danger" class="btn" @click="logout">注销登录</van-button>
            </div>
        </div>
        <van-tabbar v-model="active">
            <van-tabbar-item icon="home-o" url="/">首页</van-tabbar-item>
            <van-tabbar-item icon="search" url="/goods">搜索</van-tabbar-item>
            <van-tabbar-item icon="shopping-cart-o" :info="cartNum" url="/offer/cart-list">待报价</van-tabbar-item>
            <van-tabbar-item icon="manager-o" url="/user">个人中心</van-tabbar-item>
        </van-tabbar>
    </div>
<?= Html::jsFile('/js/center.js') ?>