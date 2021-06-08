<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Quotation;

/**
 * QuotationSearch represents the model behind the search form about `app\models\Quotation`.
 */
class QuotationSearch extends Quotation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'card_pic_and_address_id', 'goods_type_id', 'created_at', 'updated_at'], 'integer'],
            [['issue_date', 'reference_number', 'status', 'remarks', 'created_by', 'updated_by', 'validity', 'log'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Quotation::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'card_pic_and_address_id' => $this->card_pic_and_address_id,
            'goods_type_id' => $this->goods_type_id,
            'issue_date' => $this->issue_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'validity' => $this->validity,
        ]);

        $query->andFilterWhere(['like', 'reference_number', $this->reference_number])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by])
            ->andFilterWhere(['like', 'log', $this->log]);

        return $dataProvider;
    }
}
