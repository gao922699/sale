<?php


namespace app\models;


use yii\behaviors\TimestampBehavior;

class UserCost extends \app\models\gii\UserCost
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
}