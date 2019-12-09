<?php


namespace app\controllers;


use app\models\Favorite;
use app\models\Goods;
use app\models\LoginForm;
use Yii;

class UserController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (Yii::$app->request->isPost) {
            $username = Yii::$app->request->post('username');
            $password = Yii::$app->request->post('password');
            $model = new LoginForm();
            $model->username = $username;
            $model->password = $password;
            if (!$model->validate()) {
                return $this->jsonResponse(array_values($model->errors)[0][0], [], 422);
            }
            if ($model->login()) {
                return $this->jsonResponse('success');
            }
            return $this->jsonResponse('登录失败，请稍后再试');
        }
        Yii::$app->layout = 'login';
        return $this->render('login');
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->jsonResponse('success');
    }

    public function actionInfo()
    {
        return $this->jsonResponse('success', ['username' => Yii::$app->user->identity->username]);
    }

    public function actionFavoriteList()
    {
        return $this->render('favorite-list');
    }

    public function actionOfferList()
    {
        return $this->render('offer-list');
    }

    public function actionFavoritePaginate()
    {
        $pageSize = 20;
        $page = Yii::$app->request->get('page', 1);
        $keywords = Yii::$app->request->get('keywords', '');
        $offset = ($page - 1) * $pageSize;
        $favorites = Favorite::find()
            ->joinWith('goods')
            ->where(['user_id' => Yii::$app->user->identity->getId()])
            ->andFilterWhere(['like', Goods::tableName() . '.name', $keywords])
            ->orderBy('id desc')
            ->offset($offset)->limit($pageSize)
            ->asArray()
            ->all();
        return $this->jsonResponse('success', $favorites);
    }

    public function actionOfferPaginate()
    {
        return '接口：报价单分页数据';
    }
}