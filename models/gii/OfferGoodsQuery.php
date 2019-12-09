<?php

namespace app\models\gii;

/**
 * This is the ActiveQuery class for [[OfferGoods]].
 *
 * @see OfferGoods
 */
class OfferGoodsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OfferGoods[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OfferGoods|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
