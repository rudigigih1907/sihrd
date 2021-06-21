<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Absensi;

/**
 * AbsensiSearch represents the model behind the search form about `app\models\Absensi`.
 */
class AbsensiSearch extends Absensi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'karyawan_id', 'created_at', 'created_by'], 'integer'],
            [['tanggal_scan', 'tanggal', 'jam', 'pin', 'nip', 'nama', 'jabatan', 'departemen', 'kantor', 'verifikasi', 'io', 'workcode', 'sn', 'mesin', 'file', 'updated_at', 'updated_by'], 'safe'],
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
        $query = Absensi::find();

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
            'tanggal_scan' => $this->tanggal_scan,
            'tanggal' => $this->tanggal,
            'jam' => $this->jam,
            'karyawan_id' => $this->karyawan_id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'pin', $this->pin])
            ->andFilterWhere(['like', 'nip', $this->nip])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'jabatan', $this->jabatan])
            ->andFilterWhere(['like', 'departemen', $this->departemen])
            ->andFilterWhere(['like', 'kantor', $this->kantor])
            ->andFilterWhere(['like', 'verifikasi', $this->verifikasi])
            ->andFilterWhere(['like', 'io', $this->io])
            ->andFilterWhere(['like', 'workcode', $this->workcode])
            ->andFilterWhere(['like', 'sn', $this->sn])
            ->andFilterWhere(['like', 'mesin', $this->mesin])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'updated_at', $this->updated_at])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
