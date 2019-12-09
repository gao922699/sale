<?php

namespace app\models\gii;

use Yii;

/**
 * This is the model class for table "user_cost".
 *
 * @property int $id
 * @property int $user_id 用户ID
 * @property int $goods_id 商品ID
 * @property string $cost 成本价
 * @property string $created_at 创建时间
 * @property string $updated_at 更新时间
 */
class UserCost extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_cost';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'goods_id', 'cost'], 'required'],
            [['user_id', 'goods_id'], 'integer'],
            [['cost'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
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
            'cost' => '成本价',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    /**
     * {@inheritdoc}
     * @return UserCostQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserCostQuery(get_called_class());
    }
}
