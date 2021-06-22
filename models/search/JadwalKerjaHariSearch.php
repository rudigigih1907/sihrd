<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JadwalKerjaHari;

/**
 * JadwalKerjaHariSearch represents the model behind the search form about `app\models\JadwalKerjaHari`.
 */
class JadwalKerjaHariSearch extends JadwalKerjaHari
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'weekday'], 'integer'],
            [['nama', 'asli', 'default_libur'], 'safe'],
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
        $query = JadwalKerjaHari::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_ASC
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
            'weekday' => $this->weekday,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'asli', $this->asli])
            ->andFilterWhere(['like', 'default_libur', $this->default_libur]);

        return $dataProvider;
    }
}
