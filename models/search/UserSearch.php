<?php

namespace app\models\search;

use app\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserSearch represents the model behind the search form about `hscstudio\mimin\models\User`.
 */
class UserSearch extends \app\models\User
{

    public $namaKaryawan;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id', 'status', 'created_at', 'updated_at'], 'integer'],
			[['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'namaKaryawan'], 'safe'],
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
		$query = User::find()
            ->joinWith('karyawan')
        ;

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
            'sort' => [
                'attributes' => ['namaKaryawan','username'],
            ]
		]);

        $dataProvider->sort->attributes['namaKaryawan'] = [
            'asc' => ['karyawan.nama' => SORT_ASC],
            'desc'  => ['karyawan.nama' => SORT_DESC ],
        ];

        $dataProvider->sort->defaultOrder['namaKaryawan'] =SORT_ASC;
        $this->load($params);

		if (!$this->validate()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		$query->andFilterWhere([
			'id' => $this->id,
			'status' => $this->status,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
		]);

		$query->andFilterWhere(['like', 'username', $this->username])
			->andFilterWhere(['like', 'auth_key', $this->auth_key])
			->andFilterWhere(['like', 'password_hash', $this->password_hash])
			->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
			->andFilterWhere(['like', 'email', $this->email])
			->andFilterWhere(['like', 'karyawan.nama', $this->namaKaryawan])
        ;

		return $dataProvider;
	}
}
