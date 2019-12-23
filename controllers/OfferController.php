<?php


namespace app\controllers;


use app\models\Offer;
use app\models\OfferCart;
use app\models\OfferGoods;
use Yii;
use yii\db\Exception;
use yii\web\Controller;

class OfferController extends BaseController
{
    public function actionCartList()
    {
        return $this->render('cart-list');
    }

    public function actionListPaginate()
    {
        $pageSize = 20;
        $page = Yii::$app->request->get('page', 1);
        $offset = ($page - 1) * $pageSize;
        $offers = Offer::find()
            ->with('offerGoods')
            ->where(['user_id' => Yii::$app->user->identity->getId()])
            ->orderBy('id desc')
            ->offset($offset)->limit($pageSize)
            ->asArray()
            ->all();
        return $this->jsonResponse('success', $offers);
    }

    /**
     * 获取购物车列表
     * @return array
     */
    public function actionCartGoods()
    {
        $goods = OfferCart::find()
            ->with('goods')
            ->where(['user_id' => Yii::$app->user->identity->getId()])
            ->orderBy('id desc')
            ->asArray()->all();
        return $this->jsonResponse('success', $goods);
    }

    /**
     * 获取购物车商品数量
     * @return array
     */
    public function actionCartNum()
    {
        $num = OfferCart::find()->where(['user_id' => Yii::$app->user->identity->getId()])->count();
        return $this->jsonResponse('success', ['num' => $num]);
    }

    /**
     * 添加商品到待报价
     * @return string
     */
    public function actionAddCart()
    {
        $goodsId = Yii::$app->request->post('goods_id');
        if (OfferCart::find()->where(['user_id' => Yii::$app->user->identity->getId(), 'goods_id' => $goodsId])->exists()) {
            return $this->jsonResponse('请勿重复添加', [], 400);
        }
        if (OfferCart::addGoods($goodsId)) {
            return $this->jsonResponse('添加成功');
        }
        return $this->jsonResponse('添加失败', [], 500);
    }

    /**
     * 编辑购物车商品
     * @param $goodsId
     * @return array
     */
    public function actionEditCart()
    {
        $cartId = Yii::$app->request->post('id');
        $count = Yii::$app->request->post('count');
        $price = Yii::$app->request->post('price');
        $remark = Yii::$app->request->post('remark');
        $model = OfferCart::findOne($cartId);
        $model->count = $count;
        $model->price = $price;
        $model->remark = $remark;
        if ($model->save()) {
            return $this->jsonResponse('修改成功');
        }
        return $this->jsonResponse('修改失败', [], 500);
    }

    /**
     * @param $cartId
     * @return array
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDeleteCart()
    {
        $id = Yii::$app->request->post('id');
        OfferCart::findOne($id)->delete();
        return $this->jsonResponse('删除成功');
    }

    /**
     * 生成报价单
     * @return array
     */
    public function actionSave()
    {
        //生成一条offer记录，转移offer_cart表数据到offer_goods表中
        $userId = Yii::$app->user->identity->getId();
        $name = Yii::$app->request->post('name');
        $tel = Yii::$app->request->post('tel');
        $address = Yii::$app->request->post('address');
        $date = Yii::$app->request->post('date');
        if (empty($name) || empty($tel) || empty($date)) {
            return $this->jsonResponse('请填写完整信息', [], 400);
        }
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $model = new Offer();
            $model->user_id = $userId;
            $model->name = $name;
            $model->tel = $tel;
            $model->address = $address;
            $model->date = $date;
            if ($model->save()) {
                $goods = OfferCart::find()->with('goods')->where(['user_id' => $userId])->all();
                if (count($goods) == 0) {
                    throw new Exception('没有选中商品');
                }
                $data = [];
                foreach ($goods as $item) {
                    /* @var \app\models\OfferCart $item */
                    $data[] = [
                        'offer_id' => $model->id,
                        'goods_id' => $item->goods_id,
                        'offer_price' => $item->price,
                        'remark' => $item->remark,
                        'cost_price' => $item->goods->getCostPrice($userId),
                        'count' => $item->count,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    //商品被报价次数+1
                    $item->goods->incCount();
                }
                //添加记录
                Yii::$app->db->createCommand()->batchInsert(OfferGoods::tableName(), array_keys($data[0]), $data)->execute();
                //清空购物车
                OfferCart::deleteAll(['user_id' => $userId]);
            }
            $transaction->commit();
            return $this->jsonResponse('保存成功', ['offer_id' => $model->id]);
        } catch (\Exception $e) {
            $transaction->rollBack();
            return $this->jsonResponse($e->getMessage(), [], 500);
        }
    }

    public function actionDetail()
    {
        return $this->render('detail');
    }

    public function actionDetailInfo($id)
    {
        $detail = Offer::find()->with('offerGoods')->with('offerGoods.goods')->with('offerGoods.goods.cate')->with('user')->where(['id' => $id])->asArray()->one();
        return $this->jsonResponse('success', $detail);
    }

}