<?php

use yii\helpers\Html;
use yii\web\View;

/* @var $this yii\web\View */

$this->title = Yii::$app->name . '-报价单详情';

?>
<?= Html::cssFile('/css/offerDetail.css', ['position' => View::POS_HEAD]) ?>
<?= Html::jsFile('/js/html2canvas/html2canvas.min.js', ['position' => View::POS_HEAD]) ?>
    <div class="index clearfix">
        <div class="nav mb10">
            <van-nav-bar
                    title="报价单详情"
                    left-text="返回"
                    left-arrow
                    @click-left="onClickLeft"
            />
        </div>
        <van-tabs v-model="tabActive">
            <van-tab title="客户报价单">
                <div ref="image" id="offer">
                    <div>
                        <h1>报价单</h1>
                    </div>
                    <div>
                        <h2>报价对象：{{detail.name}}</h2>
                        <h2>联系方式：{{detail.tel}}</h2>
                        <h2>报价单位：{{userInfo.username}}</h2>
                        <h2>单位地址：{{userInfo.address}}</h2>
                        <h2>电话：{{userInfo.tel}}</h2>
                        <h2>联系人：{{userInfo.contact}}</h2>
                        <h2>报价商品</h2>
                    </div>
                    <van-panel :title="item.goods.name" :desc="item.remark"
                               :status="'￥'+item.offer_price + ' x '+item.count"
                               v-for="(item,index) in detail.offerGoods"
                               :key="item.id"
                    >
                        <div class="goods-item">
                            <div class="pull-left">
                                <img :src="item.goods.thumb" alt="item.goods.name"/>
                            </div>
                            <div class="pull-right">
                                <h5>型号：{{item.goods.type}}</h5>
                                <h5>分类：{{item.goods.cate.name}}</h5>
                                <h5>产品描述：{{item.goods.abstract}}</h5>
                            </div>
                        </div>
                    </van-panel>
                    <h2>总价：{{totalPrice}}</h2>
                    <h2>含税总价：{{totalTaxPrice}}</h2>
                    <h2>报价日期：{{detail.date}}</h2>
                </div>
                <div>
                    <van-button type="primary" @click="download">下载报价单</van-button>
                </div>
            </van-tab>
            <van-tab title="内部报价单">
                <div ref="imageWithCost" id="offer-with-cost">
                    <div>
                        <h1>报价单</h1>
                    </div>
                    <div>
                        <h2>报价对象：{{detail.name}}</h2>
                        <h2>联系方式：{{detail.tel}}</h2>
                        <h2>报价单位：{{userInfo.username}}</h2>
                        <h2>单位地址：{{userInfo.address}}</h2>
                        <h2>电话：{{userInfo.tel}}</h2>
                        <h2>联系人：{{userInfo.contact}}</h2>
                        <h2>报价商品</h2>
                    </div>
                    <van-panel :title="item.goods.name" :desc="item.remark"
                               :status="'￥'+item.offer_price + '（' + item.cost_price + '）' + ' x '+item.count"
                               v-for="(item,index) in detail.offerGoods"
                               :key="item.id"
                    >
                        <div class="goods-item">
                            <div class="pull-left">
                                <img :src="item.goods.thumb" alt="item.goods.name"/>
                            </div>
                            <div class="pull-right">
                                <h5>型号：{{item.goods.type}}</h5>
                                <h5>分类：{{item.goods.cate.name}}</h5>
                                <h5>产品描述：{{item.goods.abstract}}</h5>
                            </div>
                        </div>
                    </van-panel>
                    <h2>总价：{{totalPrice}}</h2>
                    <h2>含税总价：{{totalTaxPrice}}</h2>
                    <h2>总成本价：{{totalCostPrice}}</h2>
                    <h2>报价日期：{{detail.date}}</h2>
                </div>
                <div>
                    <van-button type="primary" @click="downloadWithCost">下载报价单</van-button>
                </div>
            </van-tab>
        </van-tabs>
        <van-dialog
                v-model="dialogShow"
                title="长按保存图片"
                :width="window.innerWidth * 0.8"
                confirm-button-text="关 闭"
        >
            <img :src="imageHref" style="height:100%;width:100%;">
        </van-dialog>

        <van-tabbar v-model="active">
            <van-tabbar-item icon="home-o" url="/">首页</van-tabbar-item>
            <van-tabbar-item icon="search" url="/goods">搜索</van-tabbar-item>
            <van-tabbar-item icon="shopping-cart-o" :info="cartNum" url="/offer/cart-list">待报价</van-tabbar-item>
            <van-tabbar-item icon="manager-o" url="/user">个人中心</van-tabbar-item>
        </van-tabbar>
    </div>
<?= Html::jsFile('/js/offerDetail.js') ?>