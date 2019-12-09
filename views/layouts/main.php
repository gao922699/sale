<?php
/* @var $content string */
app\assets\FrontAsset::register($this);

use yii\helpers\Html; ?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta content="telephone=no" name="format-detection">
        <meta content="black" name="apple-mobile-web-app-status-bar-style">
        <meta name="viewport" content="width=750,minimum-scale=0.2,maximum-scale=2,user-scalable=no" />
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <?= $content ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>