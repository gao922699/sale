<?php

namespace app\models\gii;

/**
 * This is the ActiveQuery class for [[OfferCart]].
 *
 * @see OfferCart
 */
class OfferCartQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OfferCart[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OfferCart|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
