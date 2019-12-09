<?php

namespace app\models\gii;

/**
 * This is the ActiveQuery class for [[Admin]].
 *
 * @see Admin
 */
class AdminQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['status' => \app\models\Admin::STATUS_ACTIVE]);
    }

    public function supplier()
    {
        return $this->andWhere(['role' => \app\models\Admin::ROLE_SUPPLIER]);
    }

    /**
     * {@inheritdoc}
     * @return Admin[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Admin|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
