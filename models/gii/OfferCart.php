<?php

namespace app\models\gii;

use Yii;

/**
 * This is the model class for table "offer_cart".
 *
 * @property int $id
 * @property int $user_id 用户ID
 * @property int $goods_id 商品ID
 * @property int $count 商品数量
 * @property string $price 报价
 * @property string $remark 备注
 * @property string $created_at 创建时间
 */
class OfferCart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offer_cart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'goods_id', 'price'], 'required'],
            [['user_id', 'goods_id', 'count'], 'integer'],
            [['price'], 'number'],
            [['created_at'], 'safe'],
            [['remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户ID',
            'goods_id' => '商品ID',
            'count' => '商品数量',
            'price' => '报价',
            'remark' => '备注',
            'created_at' => '创建时间',
        ];
    }

    /**
     * {@inheritdoc}
     * @return OfferCartQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OfferCartQuery(get_called_class());
    }
}
