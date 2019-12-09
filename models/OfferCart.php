<?php


namespace app\models;


use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * @property Goods $goods
 */
class OfferCart extends \app\models\gii\OfferCart
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false,
                'value' => date('Y-m-d H:i:s')
            ],
        ];
    }

    public function getGoods()
    {
        return $this->hasOne(Goods::class, ['id' => 'goods_id']);
    }

    public static function addGoods($goodsId)
    {
        $userId = Yii::$app->user->identity->getId();
        $model = new self;
        $model->user_id = $userId;
        $model->goods_id = $goodsId;
        $model->remark = '';
        $model->count = 1;
        $model->price = Goods::findOne($goodsId)->getCostPrice($userId);
        if ($model->save()) {
            return true;
        }
        return false;
    }
}