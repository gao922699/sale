<?php

use yii\helpers\Html;
use yii\web\View;

/* @var $this yii\web\View */

$this->title = Yii::$app->name . '-我的收藏';
?>
<?= Html::cssFile('/css/collection.css', ['position' => View::POS_HEAD]) ?>
    <div class="index clearfix">
        <div class="nav">
            <van-nav-bar
                    title="我的收藏"
                    left-text="返回"
                    left-arrow
                    @click-left="onClickLeft"
            />
        </div>
        <div class="search">
            <van-search placeholder="请输入搜索关键词" v-model="keywords" show-action @search="search"/>
            <div slot="action" @click="search">搜索</div>
        </div>
        <div class="cont clearfix">
            <van-list
                    v-model="loading"
                    :finished="finished"
                    finished-text="没有更多了"
                    @load="getList"
            >
                <div class="list"
                     v-for="(item,index) in goods"
                     :key="item.goods.id"
                     :title="item.goods.name">
                    <div class="img">
                        <img :src="item.goods.thumb" alt="" @click="jump(item.goods.id)">
                    </div>
                    <div class="name" @click="jump(item.goods.id)">
                        {{item.goods.name}}
                    </div>
                    <div class="info">
                        <div class="sc">
                            市场指导价：<span>{{item.goods.price}}元</span>
                        </div>
                        <div class="num">
                            已报价：<span>{{item.goods.count}}</span>次
                        </div>
                    </div>
                    <div class="info">
                        <div class="sc">
                            供应商：<span>{{item.supplier_username}}</span>
                        </div>
                    </div>
                    <div class="info">
                        <div class="sc">
                            供应商省市：<span>{{item.supplier_province}} - {{item.supplier_city}}</span>
                        </div>
                    </div>
                    <div class="opt">
                        <a href="javascript:;" class="collection" @click="cancel(item.goods.id,index)">取消收藏</a>
                        <van-button type="primary" class="btn" @click="addCart(item.goods.id)">我要报价</van-button>
                    </div>
                </div>
            </van-list>
        </div>
        <van-tabbar v-model="active">
            <van-tabbar-item icon="home-o" url="/">首页</van-tabbar-item>
            <van-tabbar-item icon="search" url="/goods">搜索</van-tabbar-item>
            <van-tabbar-item icon="shopping-cart-o" :info="cartNum" url="/offer/cart-list">待报价</van-tabbar-item>
            <van-tabbar-item icon="manager-o" url="/user">个人中心</van-tabbar-item>
        </van-tabbar>
    </div>
<?= Html::jsFile('/js/collection.js') ?>