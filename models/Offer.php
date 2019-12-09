<?php


namespace app\models;


use yii\behaviors\TimestampBehavior;

class Offer extends \app\models\gii\Offer
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false,
                'value' => date('Y-m-d H:i:s')
            ],
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getOfferGoods()
    {
        return $this->hasMany(OfferGoods::class, ['offer_id' => 'id']);
    }

    /**
     * 后台使用
     * @return string
     */
    public function getGoodsHtml()
    {
        $html = '<table width="100%">';
        $html .= '<tr><th width="10%">ID</th><th width="20%">名称</th><th width="10%">数量</th><th width="15%">报价</th><th width="15%">成本价</th><th width="30%">备注</th></tr>';
        $goodsArray = $this->getOfferGoods()->all();
        foreach ($goodsArray as $offerGoods) {
            /* @var OfferGoods $goods */
            $html .= '<tr>';
            $html .= '<td>' . $offerGoods->goods_id . '</td>';
            $html .= '<td>' . $offerGoods->goods->name . '</td>';
            $html .= '<td>' . $offerGoods->count . '</td>';
            $html .= '<td>' . $offerGoods->offer_price . '</td>';
            $html .= '<td>' . $offerGoods->cost_price . '</td>';
            $html .= '<td>' . $offerGoods->remark . '</td>';
            $html .= '</tr>';
        }
        $html .= '</table>';
        return $html;
    }
}