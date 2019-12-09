<?php

use yii\helpers\Html;

$this->title = Yii::$app->name.'-用户登录';
?>
<?= Html::cssFile('/css/login.css') ?>
    <div class="index clearfix">
        <div class="list mt100">
            <nut-textinput
                    placeholder="请输入用户名"
                    v-model="username"
            />
        </div>
        <div class="list">
            <nut-textinput
                    placeholder="请输入密码"
                    v-model="password"
                    type="password"
            />
        </div>
        <div class="list">
            <nut-button
                    block
                    @click="login"
            >
                登录
            </nut-button>
        </div>

    </div>
<?= Html::jsFile('/js/login.js') ?>