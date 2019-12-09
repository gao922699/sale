<?php

namespace app\modules\admin\controllers;

use app\models\Admin;
use app\models\AdminLoginForm;
use app\models\Cate;
use app\models\Goods;
use app\models\Offer;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\filters\VerbFilter;

class DefaultController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'user' => 'admin',
                'only' => ['logout', 'index'],
                'rules' => [
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
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
        if (Admin::isAdmin()) {
            $goodsCount = Goods::find()->active()->count();
            $supplierCount = Admin::find()->supplier()->active()->count();
            $offerCount = Offer::find()->count();
            $userCount = User::find()->active()->count();
            return $this->render('admin-index', [
                'goodsCount' => $goodsCount,
                'supplierCount' => $supplierCount,
                'offerCount' => $offerCount,
                'userCount' => $userCount,
            ]);
        }
        if (Admin::isGoodsAdmin()) {
            $cateCount = Cate::find()->count();
            $goodsCount = Goods::find()->active()->count();
            return $this->render('goods-admin-index', [
                'cateCount' => $cateCount,
                'goodsCount' => $goodsCount,
            ]);
        }
        if (Admin::isSupplier()) {
            $goodsCount = Goods::find()->where(['admin_id' => Yii::$app->admin->identity->id])->active()->count();
            $goodsOfferCount = Goods::find()->where(['admin_id' => Yii::$app->admin->identity->id])->active()->sum('count') ?? 0;
            return $this->render('supplier-index', [
                'goodsCount' => $goodsCount,
                'goodsOfferCount' => $goodsOfferCount,
            ]);
        }
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->admin->isGuest) {
            return $this->redirect('admin');
        }

        $model = new AdminLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->admin->logout();

        return $this->redirect('login');
    }
}
