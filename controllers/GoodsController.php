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
        $goods = Goods::find()->with('admin')->with('cate')->active()->where(['id' => $id])->one();
        $cost = $goods->getCostPrice($userId);

        $result['id'] = $goods->id;
        $result['name'] = $goods->name;
        $result['thumb'] = $goods->thumb;
        $result['carousel'] = $goods->carousel;
        $result['abstract'] = $goods->abstract;
        $result['detail'] = $goods->detail;
        $result['cate_name'] = $goods->cate->name;
        $result['type'] = $goods->type;
        $result['brand'] = $goods->brand;
        $result['price'] = $goods->price;
        $result['cost'] = $cost;
        $result['count'] = $goods->count;
        $result['supplier_username'] = $goods->admin->username;
        $result['supplier_province'] = $goods->admin->province;
        $result['supplier_city'] = $goods->admin->city;
        $result['supplier_address'] = $goods->admin->address;
        $result['supplier_contact'] = $goods->admin->contact;
        $result['supplier_tel'] = $goods->admin->tel;
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
    public function actionPaginate($page = 1, $cateId = null, $keywords = '')
    {
        $pageSize = 20;
        $offset = ($page - 1) * $pageSize;
        $goods = Goods::find()
            ->with('admin')
            ->andFilterWhere(['cate_id' => $cateId])
            ->andFilterWhere(['like', 'name', $keywords])
            ->active()
            ->orderBy('count desc,id desc')
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
                'supplier_username' => $item->admin->username,
                'supplier_province' => $item->admin->province,
                'supplier_city' => $item->admin->city,
                'is_favorite' => Favorite::isFavorite($item->id),
            ];
        }
        return $this->jsonResponse('success', $results);
    }
}