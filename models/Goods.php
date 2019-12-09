<?php


namespace app\models;


use yii\behaviors\TimestampBehavior;

class Goods extends \app\models\gii\Goods
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

    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;

    public static $statusMap = [
        self::STATUS_ACTIVE => '正常',
        self::STATUS_DELETED => '禁用',
    ];

    public function getAdmin()
    {
        return $this->hasOne(Admin::class, ['id' => 'admin_id']);
    }

    public function getCate()
    {
        return $this->hasOne(Cate::class, ['id' => 'cate_id']);
    }

    public function getCarouselHtml()
    {
        $html = '';
        $carousels = explode(',', $this->carousel);
        foreach ($carousels as $carousel) {
            $html .= '<img class="preview" src="' . $carousel . '">';
        }
        return $html;
    }

    /**
     * 获取商品成本价
     * @param $userId
     * @param $goodsId
     * @return string
     */
    public function getCostPrice($userId)
    {
        if ($userCost = UserCost::find()->where(['user_id' => $userId, 'goods_id' => $this->id])->one()) {
            return $userCost->cost;
        } else {
            return $this->price;
        }
    }

    public function incCount(){
        $this->count++;
        $this->save();
    }

}