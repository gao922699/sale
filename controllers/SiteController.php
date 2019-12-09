<?php

namespace app\controllers;

use app\models\Banner;
use app\models\Goods;
use Yii;


class SiteController extends BaseController
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $banners = Banner::find()->orderBy('order ASC,id DESC')->asArray()->all();
        return $this->render('index');
    }

    public function actionBanners()
    {
        $banners = Banner::find()->orderBy('order ASC,id DESC')->asArray()->all();
        return $this->jsonResponse('success', $banners);
    }
}
