<?php


namespace app\controllers;


use app\models\Cate;
use app\models\Favorite;
use app\models\Goods;
use app\models\UserCost;
use Yii;
use yii\web\Controller;

class GoodsController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionList()
    {
        return $this->render('list');
    }

    public function actionTopCates()
    {
        $topCates = Cate::getTopCates();
        $results = [];
        foreach ($topCates as $id => $name) {
            $results[] = [
                'id' => $id,
                'text' => $name
            ];
        }
        return $this->jsonResponse('success', $results);
    }

    public function actionChildCates($topCateId)
    {
        $childCates = Cate::find()->where(['parent_id' => $topCateId])->asArray()->all();
        return $this->jsonResponse('success', $childCates);
    }

    public function actionDetail($id)
    {
        return $this->render('detail');
    }

    public function actionDetailInfo($id)
    {
        $userId = Yii::$app->user->identity->getId();
        $goods = Goods::find()->active()->where(['id' => $id])->with('cate')->one();
        $cost = $goods->getCostPrice($userId);
        $result = $goods->toArray();
        $result['cost'] = $cost;
        return $this->jsonResponse('success', $result);
    }

    public function actionSetCost()
    {
        $id = Yii::$app->request->post('id');
        $price = Yii::$app->request->post('price');
        $userId = Yii::$app->user->identity->getId();
        if ($model = UserCost::find()->where(['user_id' => $userId, 'goods_id' => $id])->one()) {
            $model->cost = $price;
            $model->save();
        } else {
            $model = new UserCost();
            $model->user_id = $userId;
            $model->cost = $price;
            $model->goods_id = $id;
            $model->save();
        }
        return $this->jsonResponse('修改成本价成功');
    }

    /**
     * 添加/取消收藏
     * @return array
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionSwitchFavorite()
    {
        $goodsId = Yii::$app->request->post('goods_id');
        $userId = Yii::$app->user->identity->id;
        $model = Favorite::find()->where(['user_id' => $userId, 'goods_id' => $goodsId])->one();
        if ($model) {
            $model->delete();
            return $this->jsonResponse('取消收藏成功');
        } else {
            $favorite = new Favorite();
            $favorite->user_id = $userId;
            $favorite->goods_id = $goodsId;
            $favorite->save();
            return $this->jsonResponse('添加收藏成功');
        }
    }

    /**
     * 商品列表
     * @param int $page
     * @param string $cateId
     * @param string $keywords
     * @return array
     */
    public function actionPaginate($page = 1, $cateId = '', $keywords = '')
    {
        $pageSize = 20;
        $offset = ($page - 1) * $pageSize;
        $goods = Goods::find()
            ->andFilterWhere(['cateId' => $cateId])
            ->andFilterWhere(['like', 'name', $keywords])
            ->active()
            ->orderBy('count desc')
            ->limit($pageSize)->offset($offset)
            ->all();
        $results = [];
        foreach ($goods as $item) {
            $results[] = [
                'id' => $item->id,
                'name' => $item->name,
                'price' => $item->price,
                'count' => $item->count,
                'thumb' => $item->thumb,
                'is_favorite' => Favorite::isFavorite($item->id),
            ];
        }
        return $this->jsonResponse('success', $results);
    }
}