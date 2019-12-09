<?php


namespace app\models;


use yii\behaviors\TimestampBehavior;

class Banner extends \app\models\gii\Banner
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