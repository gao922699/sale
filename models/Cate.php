<?php


namespace app\models;


use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

class Cate extends \app\models\gii\Cate
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => date('Y-m-d H:i:s')
            ],
        ];
    }

    public function getGoods()
    {
        return $this->hasMany(Goods::class, ['cate_id' => 'id']);
    }

    /**
     * @return Cate
     */
    public function getParentCate()
    {
        return self::findOne($this->parent_id) ?? new self;
    }

    /**
     * @return array
     */
    public static function getTopCates()
    {
        $topCates = self::find()->select(['id', 'name'])
            ->where(['parent_id' => 0])
            ->orWhere(['parent_id' => null])
            ->orderBy('order ASC,id DESC')->all();
        return ArrayHelper::map($topCates, 'id', 'name');
    }

    /**
     * @param $topCateId
     * @return Cate[]|array
     */
    public static function getChildCates($topCateId)
    {
        $cates = self::find()->select(['id', 'name'])
            ->where(['parent_id' => $topCateId])
            ->orderBy('order ASC,id DESC')
            ->asArray()->all();
        return ArrayHelper::map($cates, 'id', 'name');
    }

    /**
     * @return array
     */
    public static function getCateTree()
    {
        $topCates = self::getTopCates();
        $result = [];
        foreach ($topCates as $id => $name) {
            $result[$name] = self::getChildCates($id);
        }
        return $result;
    }
}