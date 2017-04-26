<?php
	
	namespace backend\models;
	
	use Yii;
	use yii\base\Model;
	use yii\data\ActiveDataProvider;
	use backend\models\AdminUser;
	
	/**
	 * AdminUserSearch represents the model behind the search form about `backend\models\AdminUser`.
	 */
	class AdminUserSearch extends AdminUser
	{
		/**
		 * @inheritdoc
		 */
		public function rules()
		{
			return [
				[['id', 'updated_at', 'created_at', 'isAdmin'], 'integer'],
				[['username', 'auth_key', 'password_hash', 'email', 'api_token'], 'safe'],
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
			$query = AdminUser::find();
			
			// add conditions that should always apply here
			
			$dataProvider = new ActiveDataProvider([
				'query' => $query,
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
				'updated_at' => $this->updated_at,
				'created_at' => $this->created_at,
				'isAdmin' => $this->isAdmin,
			]);
			
			$query->andFilterWhere(['like', 'username', $this->username])
				->andFilterWhere(['like', 'auth_key', $this->auth_key])
				->andFilterWhere(['like', 'password_hash', $this->password_hash])
				->andFilterWhere(['like', 'email', $this->email])
				->andFilterWhere(['like', 'api_token', $this->api_token]);
			
			return $dataProvider;
		}
	}