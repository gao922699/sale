<?php

namespace app\models\gii;

/**
 * This is the ActiveQuery class for [[Cate]].
 *
 * @see Cate
 */
class CateQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Cate[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Cate|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
