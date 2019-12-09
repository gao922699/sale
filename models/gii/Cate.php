<?php

namespace app\models\gii;

use Yii;

/**
 * This is the model class for table "cate".
 *
 * @property int $id
 * @property string $name 名称
 * @property string $photo 图片
 * @property int $parent_id 父级分类ID
 * @property int $order 排序
 * @property string $created_at 创建时间
 * @property string $updated_at 更新时间
 */
class Cate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'photo'], 'required'],
            [['parent_id', 'order'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'photo'], 'string', 'max' => 255],
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
            'photo' => '图片',
            'parent_id' => '父级分类ID',
            'order' => '排序',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    /**
     * {@inheritdoc}
     * @return CateQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CateQuery(get_called_class());
    }
}
