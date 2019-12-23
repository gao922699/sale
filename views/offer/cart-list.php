<?php

use yii\helpers\Html;
use yii\web\View;

/* @var $this yii\web\View */

$this->title = Yii::$app->name . '-待报价商品';

?>
<?= Html::cssFile('/css/quote.css', ['position' => View::POS_HEAD]) ?>
    <div class="index clearfix">
        <div class="nav">
            <van-nav-bar
                    title="待报价商品"
                    left-text="返回"
                    left-arrow
                    @click-left="onClickLeft"
            />
        </div>
        <div class="cont clearfix">
            <div class="list"
                 v-for="(item,index) in goods"
                 :key="item.goods.id"
                 :title="item.goods.name">
                <div class="img">
                    <img :src="item.goods.thumb" alt="">
                </div>
                <div class="box">
                    <div class="name">
                        {{item.goods.name}}
                    </div>
                    <div class="info">
                        <div class="sc">
                            报价：<span>{{item.price}}元</span>
                        </div>
                        <div class="num">
                            数量：<span>{{item.count}}</span>个
                        </div>
                    </div>
                    <div class="opt">
                        <van-button type="danger" class="btn" @click="del(item,index)">删除</van-button>
                        <van-button type="primary" class="btn" @click="edit(item,index)">编辑</van-button>
                    </div>
                </div>
            </div>
        </div>

        <div class="fixed">
            <van-button type="primary" class="btn" @click="bjshow = true">立即报价</van-button>
        </div>
        <van-overlay :show="show" @click="show = false">
            <div class="wrapper" @click.stop>
                <div class="overBox">
                    <p class="title">编辑</p>
                    <div class="overCont">
                        <div class="item clearfix">
                            <div class="itemLeft">报价数量：</div>
                            <div class="itemRight">
                                <van-stepper
                                        button-size="80px"
                                        input-width="100px"
                                        v-model="count"/>
                            </div>
                        </div>
                        <div class="item clearfix">
                            <div class="itemLeft clearfix">价格：</div>
                            <div class="itemRight">
                                <input type="text" v-model="price"/>
                            </div>
                        </div>
                        <div class="item clearfix">
                            <div class="itemLeft">备注：</div>
                            <div class="itemRight">
                                <textarea rows="5" cols="40" v-model="remark"></textarea>
                            </div>
                        </div>
                        <div class="itemBtn clearfix">
                            <van-button type="default" class="btn" @click="show = false">取消</van-button>
                            <van-button type="primary" class="btn" @click="doEdit()">确认</van-button>
                        </div>
                    </div>
                </div>
            </div>
        </van-overlay>
        <van-overlay :show="bjshow" @click="bjshow = false">
            <div class="wrapper" @click.stop>
                <div class="overBox">
                    <p class="title">报价信息</p>
                    <div class="overCont two">
                        <div class="item clearfix">
                            <div class="itemLeft">名称：</div>
                            <div class="itemRight">
                                <input type="text" v-model="name"/>
                            </div>
                        </div>
                        <div class="item clearfix">
                            <div class="itemLeft clearfix">电话：</div>
                            <div class="itemRight">
                                <input type="text" v-model="tel"/>
                            </div>
                        </div>
                        <div class="item clearfix">
                            <div class="itemLeft clearfix">地址：</div>
                            <div class="itemRight">
                                <input type="text" v-model="address"/>
                            </div>
                        </div>
                        <div class="item clearfix">
                            <div class="itemLeft">日期：</div>
                            <div class="itemRight">
                                <input type="text" v-model="date" disabled/>
                            </div>
                        </div>
                        <div class="selectTime clearfix" v-if="showdate">
                            <van-datetime-picker
                                    v-model="currentDate"
                                    type="date"
                                    @confirm="confirmDate"
                                    @cancel="cancelDate"
                                    :min-date="minDate"
                            />
                        </div>
                        <div class="itemBtn clearfix">
                            <van-button type="default" class="btn" @click="bjshow = false">取消</van-button>
                            <van-button type="primary" class="btn" @click="offer()">生成报价单</van-button>
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
<?= Html::jsFile('/js/quote.js') ?>