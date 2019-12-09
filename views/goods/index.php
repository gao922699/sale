<?php

$this->title = Yii::$app->name . '-分类搜索';

use yii\helpers\Html;
use yii\web\View; ?>
<?= Html::cssFile('/css/search.css', ['position' => View::POS_HEAD]) ?>
<div class="index clearfix">
    <div class="nav">
        <van-nav-bar
                title="分类搜索"
                left-text="返回"
                left-arrow
                @click-left="onClickLeft"
        />
    </div>
    <div class="search">
        <van-search placeholder="请输入商品关键词" v-model="keywords" show-action @search="search"/>
        <div slot="action" @click="search">搜索</div>
    </div>
    <div class="cont clearfix">
        <van-tree-select
                height="55vw"
                :items="topCates"
                :main-active-index.sync="activeIndex"
                @click-nav="getChildCates">
            <div slot="content">
                <div class="list"
                     v-for="(item,index) in childCates"
                     :key="item.id"
                     :title="item.name">
                    <div class="img" @click="showGoods(item.id)">
                        <img :src="item.photo" :alt="item.name">
                    </div>
                    <div class="name" @click="showGoods(item.id)">
                        {{item.name}}
                    </div>
                </div>
            </div>
        </van-tree-select>
    </div>
    <van-tabbar v-model="active">
        <van-tabbar-item icon="home-o" url="/">首页</van-tabbar-item>
        <van-tabbar-item icon="search" url="/goods">搜索</van-tabbar-item>
        <van-tabbar-item icon="shopping-cart-o" :info="cartNum" url="/offer/cart-list">待报价</van-tabbar-item>
        <van-tabbar-item icon="manager-o" url="/user">个人中心</van-tabbar-item>
    </van-tabbar>
</div>
<?= Html::jsFile('/js/search.js') ?>
