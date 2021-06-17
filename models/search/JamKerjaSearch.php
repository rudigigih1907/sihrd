<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JamKerja;

/**
 * JamKerjaSearch represents the model behind the search form about `app\models\JamKerja`.
 */
class JamKerjaSearch extends JamKerja
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dihitung', 'toleransi_terlambat', 'created_at', 'updated_at'], 'integer'],
            [['nama', 'kode', 'jam_masuk', 'jam_mulai_istrahat', 'jam_selesai_istrahat', 'jam_pulang', 'durasi', 'created_by', 'updated_by'], 'safe'],
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
        $query = JamKerja::find();

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
            'jam_masuk' => $this->jam_masuk,
            'jam_mulai_istrahat' => $this->jam_mulai_istrahat,
            'jam_selesai_istrahat' => $this->jam_selesai_istrahat,
            'jam_pulang' => $this->jam_pulang,
            'dihitung' => $this->dihitung,
            'toleransi_terlambat' => $this->toleransi_terlambat,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'kode', $this->kode])
            ->andFilterWhere(['like', 'durasi', $this->durasi])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
