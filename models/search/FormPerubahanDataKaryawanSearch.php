<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FormPerubahanDataKaryawan;

/**
 * FormPerubahanDataKaryawanSearch represents the model behind the search form about `app\models\FormPerubahanDataKaryawan`.
 */
class FormPerubahanDataKaryawanSearch extends FormPerubahanDataKaryawan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['judul', 'deskripsi_umum', 'status', 'aksi_yang_dilakukan'], 'safe'],
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
        $query = FormPerubahanDataKaryawan::find();

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
        ]);

        $query->andFilterWhere(['like', 'judul', $this->judul])
            ->andFilterWhere(['like', 'deskripsi_umum', $this->deskripsi_umum])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'aksi_yang_dilakukan', $this->aksi_yang_dilakukan]);

        return $dataProvider;
    }
}
