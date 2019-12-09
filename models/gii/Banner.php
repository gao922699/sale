<?php

namespace app\models\gii;

use Yii;

/**
 * This is the model class for table "banner".
 *
 * @property int $id
 * @property string $src 图片地址
 * @property string $alt 图片说明
 * @property string|null $url 跳转地址
 * @property int $order 排序
 * @property string|null $created_at 创建时间
 * @property string|null $updated_at 更新时间
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['src', 'alt'], 'required'],
            [['order'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['src', 'alt', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'src' => '图片地址',
            'alt' => '图片说明',
            'url' => '跳转地址',
            'order' => '排序',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    /**
     * {@inheritdoc}
     * @return BannerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BannerQuery(get_called_class());
    }
}
