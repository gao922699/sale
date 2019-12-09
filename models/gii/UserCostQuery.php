<?php

namespace app\models\gii;

/**
 * This is the ActiveQuery class for [[UserCost]].
 *
 * @see UserCost
 */
class UserCostQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UserCost[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserCost|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
