<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Karyawan;

/**
 * KaryawanSearch represents the model behind the search form about `app\models\Karyawan`.
 */
class KaryawanSearch extends Karyawan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'agama_id', 'status_perkawinan_id', 'alasan_berhenti_bekerja', 'created_at', 'updated_at'], 'integer'],
            [['nomor_induk_karyawan', 'nama', 'nama_panggilan', 'tempat_lahir', 'tanggal_lahir', 'status_kewarganegaraan', 'nomor_kartu_tanda_penduduk', 'nomor_kartu_keluarga', 'nomor_pokok_wajib_pajak', 'nomor_kitas_atau_sejenisnya', 'jenis_kelamin', 'nama_ayah', 'nama_ibu', 'pendidikan_terakhir', 'tanggal_mulai_bekerja', 'tanggal_berhenti_bekerja', 'created_by', 'updated_by'], 'safe'],
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
        $query = Karyawan::find();

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
            'tanggal_lahir' => $this->tanggal_lahir,
            'agama_id' => $this->agama_id,
            'status_perkawinan_id' => $this->status_perkawinan_id,
            'tanggal_mulai_bekerja' => $this->tanggal_mulai_bekerja,
            'tanggal_berhenti_bekerja' => $this->tanggal_berhenti_bekerja,
            'alasan_berhenti_bekerja' => $this->alasan_berhenti_bekerja,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nomor_induk_karyawan', $this->nomor_induk_karyawan])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'nama_panggilan', $this->nama_panggilan])
            ->andFilterWhere(['like', 'tempat_lahir', $this->tempat_lahir])
            ->andFilterWhere(['like', 'status_kewarganegaraan', $this->status_kewarganegaraan])
            ->andFilterWhere(['like', 'nomor_kartu_tanda_penduduk', $this->nomor_kartu_tanda_penduduk])
            ->andFilterWhere(['like', 'nomor_kartu_keluarga', $this->nomor_kartu_keluarga])
            ->andFilterWhere(['like', 'nomor_pokok_wajib_pajak', $this->nomor_pokok_wajib_pajak])
            ->andFilterWhere(['like', 'nomor_kitas_atau_sejenisnya', $this->nomor_kitas_atau_sejenisnya])
            ->andFilterWhere(['like', 'jenis_kelamin', $this->jenis_kelamin])
            ->andFilterWhere(['like', 'nama_ayah', $this->nama_ayah])
            ->andFilterWhere(['like', 'nama_ibu', $this->nama_ibu])
            ->andFilterWhere(['like', 'pendidikan_terakhir', $this->pendidikan_terakhir])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
