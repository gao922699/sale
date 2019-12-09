<?php

namespace app\models\gii;

/**
 * This is the ActiveQuery class for [[Goods]].
 *
 * @see Goods
 */
class GoodsQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['status' => \app\models\Goods::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     * @return Goods[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Goods|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
