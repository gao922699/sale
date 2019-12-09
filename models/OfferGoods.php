<?php


namespace app\models;


use yii\behaviors\TimestampBehavior;

class OfferGoods extends \app\models\gii\OfferGoods
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

    public function getOffer()
    {
        return $this->hasOne(Offer::class, ['id' => 'offer_id']);
    }
}