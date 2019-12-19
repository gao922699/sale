<?php

use yii\helpers\Html;
use yii\web\View;

/* @var $this yii\web\View */

$this->title = Yii::$app->name . '-商品详情';

?>
<?= Html::cssFile('/css/listDetail.css', ['position' => View::POS_HEAD]) ?>
    <div class="index clearfix">
        <div class="nav mb10">
            <van-nav-bar
                    :title="detail.name"
                    left-text="返回"
                    left-arrow
                    @click-left="onClickLeft"
            />
        </div>
        <div class="detail">
            <div class="detailImg">
                <van-swipe :autoplay="3000" indicator-color="white">
                    <van-swipe-item v-for="banner in detail.carousel">
                        <img :src="banner" :alt="detail.name"/>
                    </van-swipe-item>
                </van-swipe>
            </div>
            <div class="detailInfo">
                <h3 class="mb10">{{detail.name}}</h3>
                <div class="price">
                    <div class="sc">
                        品牌：<span>{{detail.brand}}</span>
                    </div>
                    <div class="num">
                        型号：<span>{{detail.type}}</span>
                    </div>
                </div>
                <div class="price">
                    <div class="sc">
                        市场指导价：<span>{{detail.price}}元</span>
                    </div>
                    <div class="num">
                        已报价：<span>{{detail.count}}</span>次
                    </div>
                </div>
                <div class="price">
                    <div class="sc">
                        供应商：<span>{{detail.supplier_username}}</span>
                    </div>
                </div>
                <div class="price">
                    <div class="sc">
                        供应商省市：<span>{{detail.supplier_province}} - {{detail.supplier_city}}</span>
                    </div>
                </div>
                <div class="price">
                    <div class="sc">
                        供应商地址：<span>{{detail.supplier_address}}</span>
                    </div>
                </div>
                <div class="price">
                    <div class="sc">
                        供应商联系方式：<span>{{detail.supplier_contact}} - {{detail.supplier_tel}}</span>
                    </div>
                </div>
                <div class="price">
                    <div class="sc">
                        成本价：<span>{{detail.cost}}元</span>
                    </div>
                    <div class="num">
                      <van-button type="primary" class="btn" @click="show = true">修改</van-button>
                    </div>
                </div>
                <p class="text mb10" v-html="detail.detail"></p>
            </div>
        </div>
        <div class="bottomNav">
            <van-goods-action>
                <van-goods-action-button type="danger" text="添加报价" @click="addCart"/>
            </van-goods-action>
        </div>
        <van-overlay :show="show" @click="show = false">
            <div class="wrapper" @click.stop>
                <div class="overBox">
                    <p class="title">编辑</p>
                    <div class="overCont">
                        <div class="item clearfix">
                            <div class="itemLeft clearfix">成本价：</div>
                            <div class="itemRight">
                                <input type="text" v-model="cost_price"/>
                            </div>
                        </div>
                        <div class="itemBtn clearfix">
                            <van-button type="default" class="btn" @click="show = false">取消</van-button>
                            <van-button type="primary" class="btn" @click="setCost">确认</van-button>
                        </div>
                    </div>
                </div>
            </div>
        </van-overlay>
        <van-tabbar v-model="active">
            <van-tabbar-item icon="home-o" url="/">首页</van-tabbar-item>
            <van-tabbar-item icon="search" url="/goods">搜索</van-tabbar-item>
            <van-tabbar-item icon="shopping-cart-o" :info="cartNum" url="/offer/cart-list">待报价</van-tabbar-item>
            <van-tabbar-item icon="manager-o" url="/user">个人中心</van-tabbar-item>
        </van-tabbar>
    </div>
<?= Html::jsFile('/js/listDetail.js') ?>