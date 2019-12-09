<?php

namespace app\models\gii;

use Yii;

/**
 * This is the model class for table "offer_goods".
 *
 * @property int $id
 * @property int $offer_id 报价单ID
 * @property int $goods_id 商品ID
 * @property int $count 商品数量
 * @property string $remark 备注
 * @property string $offer_price 报价
 * @property string $cost_price 成本价
 * @property string $created_at 创建时间
 */
class OfferGoods extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offer_goods';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['offer_id', 'goods_id', 'offer_price', 'cost_price'], 'required'],
            [['offer_id', 'goods_id', 'count'], 'integer'],
            [['offer_price', 'cost_price'], 'number'],
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
            'offer_id' => '报价单ID',
            'goods_id' => '商品ID',
            'count' => '商品数量',
            'remark' => '备注',
            'offer_price' => '报价',
            'cost_price' => '成本价',
            'created_at' => '创建时间',
        ];
    }

    /**
     * {@inheritdoc}
     * @return OfferGoodsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OfferGoodsQuery(get_called_class());
    }
}
