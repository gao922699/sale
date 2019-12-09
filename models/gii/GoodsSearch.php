<?php

namespace app\models\gii;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Goods;

/**
 * GoodsSearch represents the model behind the search form of `app\models\gii\Goods`.
 */
class GoodsSearch extends Goods
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cate_id', 'count', 'status', 'admin_id'], 'integer'],
            [['name', 'thumb', 'carousel', 'detail', 'type', 'brand', 'created_at', 'updated_at'], 'safe'],
            [['price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Goods::find();

        // add conditions that should always apply here
        if(\app\models\Admin::isSupplier()){
            $adminId = Yii::$app->admin->identity->id;
            $query->where(['admin_id' => $adminId]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'cate_id' => $this->cate_id,
            'price' => $this->price,
            'count' => $this->count,
            'status' => $this->status,
            'admin_id' => $this->admin_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'thumb', $this->thumb])
            ->andFilterWhere(['like', 'carousel', $this->carousel])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'brand', $this->brand]);

        return $dataProvider;
    }
}
