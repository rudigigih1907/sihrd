<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\KehadiranDiInternalSistem;

/**
 * KehadiranDiInternalSistemSearch represents the model behind the search form about `app\models\KehadiranDiInternalSistem`.
 */
class KehadiranDiInternalSistemSearch extends KehadiranDiInternalSistem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'jadwal_kerja_id', 'jadwal_kerja_hari_id', 'jam_kerja_id', 'karyawan_id', 'jenis_izin_id', 'cuti_normatif_id'], 'integer'],
            [['ketentuan_masuk', 'ketentuan_pulang', 'aktual_masuk', 'aktual_pulang'], 'safe'],
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
        $query = KehadiranDiInternalSistem::find();

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
            'jadwal_kerja_id' => $this->jadwal_kerja_id,
            'jadwal_kerja_hari_id' => $this->jadwal_kerja_hari_id,
            'jam_kerja_id' => $this->jam_kerja_id,
            'ketentuan_masuk' => $this->ketentuan_masuk,
            'ketentuan_pulang' => $this->ketentuan_pulang,
            'karyawan_id' => $this->karyawan_id,
            'aktual_masuk' => $this->aktual_masuk,
            'aktual_pulang' => $this->aktual_pulang,
            'jenis_izin_id' => $this->jenis_izin_id,
            'cuti_normatif_id' => $this->cuti_normatif_id,
        ]);

        return $dataProvider;
    }
}
