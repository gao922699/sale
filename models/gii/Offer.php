<?php

namespace app\models\gii;

use Yii;

/**
 * This is the model class for table "offer".
 *
 * @property int $id
 * @property int $user_id 用户ID
 * @property string $name 报价对象名称
 * @property string $tel 报价对象电话
 * @property string $date 报价日期
 * @property string $created_at 创建时间
 */
class Offer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'tel', 'date'], 'required'],
            [['user_id'], 'integer'],
            [['date', 'created_at'], 'safe'],
            [['name', 'tel'], 'string', 'max' => 255],
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
            'name' => '报价对象名称',
            'tel' => '报价对象电话',
            'date' => '报价日期',
            'created_at' => '创建时间',
        ];
    }

    /**
     * {@inheritdoc}
     * @return OfferQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OfferQuery(get_called_class());
    }
}
