<?php

namespace app\modules\admin\controllers;

use app\models\Admin;
use app\models\Cate;
use app\models\OfferGoods;
use Yii;
use app\models\Goods;
use app\models\gii\GoodsSearch;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GoodsController implements the CRUD actions for Goods model.
 */
class GoodsController extends BaseController
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
                'rules' => [
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['create', 'update', 'switch', 'get-child-cates','upload'],
                        'matchCallback' => function ($rule, $action) {
                            return (Admin::isAdmin() || Admin::isGoodsAdmin());
                        },
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['offer-history'],
                        'matchCallback' => function ($rule, $action) {
                            if (Admin::isAdmin()) {
                                return true;
                            }
                            if (Admin::isSupplier()) {
                                $goodsId = Yii::$app->request->get('id');
                                $adminId = Yii::$app->admin->identity->id;
                                if (Goods::find()->where(['id' => $goodsId, 'admin_id' => $adminId])->exists()) {
                                    return true;
                                }
                            }
                            return false;
                        },
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
            ]
        ];
    }

    /**
     * Lists all Goods models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GoodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Goods model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Goods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Goods();

        if ($model->load(Yii::$app->request->post())) {
            $model->status = Goods::STATUS_ACTIVE;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * Updates an existing Goods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Goods model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionSwitch($id)
    {
        $model = $this->findModel($id);
        if ($model->status == Admin::STATUS_ACTIVE) {
            $model->status = Admin::STATUS_DELETED;
            $model->save(false);
        } else if ($model->status == Admin::STATUS_DELETED) {
            $model->status = Admin::STATUS_ACTIVE;
            $model->save(false);
        }
        return $this->redirect(['index']);
    }

    /**
     * 获取二级分类
     * @param $id
     * @return Cate[]|array
     */
    public function actionGetChildCates($id)
    {
        Yii::$app->response->format = 'json';
        return Cate::getChildCates($id);
    }

    public function actionOfferHistory($id)
    {
        $query = OfferGoods::find()->where(['goods_id' => $id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
        ]);
        return $this->render('offer-history', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the Goods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Goods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goods::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
