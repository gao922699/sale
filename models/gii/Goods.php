<?php

namespace app\models\gii;

use Yii;

/**
 * This is the model class for table "goods".
 *
 * @property int $id
 * @property string $name 名称
 * @property string $thumb 缩略图
 * @property string|null $carousel 轮播图
 * @property string|null $abstract 简介
 * @property string|null $detail 详情
 * @property int $cate_id 分类
 * @property string $type 型号
 * @property string $brand 品牌
 * @property float $price 建议零售价
 * @property int|null $count 被报价次数
 * @property int $status 状态
 * @property int $admin_id 所属供应商
 * @property string|null $created_at 创建时间
 * @property string|null $updated_at 更新时间
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'thumb', 'cate_id', 'type', 'brand', 'price', 'status', 'admin_id'], 'required'],
            [['carousel', 'detail'], 'string'],
            [['cate_id', 'count', 'status', 'admin_id'], 'integer'],
            [['price'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'thumb', 'abstract'], 'string', 'max' => 255],
            [['type', 'brand'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'thumb' => '缩略图',
            'carousel' => '轮播图',
            'abstract' => '简介',
            'detail' => '详情',
            'cate_id' => '分类',
            'type' => '型号',
            'brand' => '品牌',
            'price' => '建议零售价',
            'count' => '被报价次数',
            'status' => '状态',
            'admin_id' => '所属供应商',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    /**
     * {@inheritdoc}
     * @return GoodsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GoodsQuery(get_called_class());
    }
}
