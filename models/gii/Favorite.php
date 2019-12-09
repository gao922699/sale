<?php

namespace app\models\gii;

use Yii;

/**
 * This is the model class for table "favorite".
 *
 * @property int $id
 * @property int $user_id 用户ID
 * @property int $goods_id 商品ID
 * @property string $created_at 创建时间
 */
class Favorite extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favorite';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'goods_id'], 'required'],
            [['user_id', 'goods_id'], 'integer'],
            [['created_at'], 'safe'],
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
            'created_at' => '创建时间',
        ];
    }

    /**
     * {@inheritdoc}
     * @return FavoriteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FavoriteQuery(get_called_class());
    }
}
