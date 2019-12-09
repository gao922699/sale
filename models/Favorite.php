<?php


namespace app\models;


use Yii;
use yii\behaviors\TimestampBehavior;

class Favorite extends \app\models\gii\Favorite
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

    /**
     * 用户是否收藏了该商品
     * @param $goodsId
     * @return bool
     */
    public static function isFavorite($goodsId)
    {
        return Favorite::find()->where(['user_id' => Yii::$app->user->identity->id, 'goods_id' => $goodsId])->exists();
    }
}