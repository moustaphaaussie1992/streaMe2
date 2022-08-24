<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Users;

/**
 * UsersSearch represents the model behind the search form of `app\models\Users`.
 */
class UsersSearch extends Users {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'role', 'is_approved'], 'integer'],
            [['fullname', 'password', 'username', 'token', 'link_facebook', 'link_youtube', 'link_instagram', 'link_tiktok', 'profile_picture'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Users::find();

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
            'role' => 1,
            'is_approved' => $this->is_approved,
        ]);

        $query->andFilterWhere(['like', 'fullname', $this->fullname])
                ->andFilterWhere(['like', 'password', $this->password])
                ->andFilterWhere(['like', 'username', $this->username])
                ->andFilterWhere(['like', 'token', $this->token])
                ->andFilterWhere(['like', 'link_facebook', $this->link_facebook])
                ->andFilterWhere(['like', 'link_youtube', $this->link_youtube])
                ->andFilterWhere(['like', 'link_instagram', $this->link_instagram])
                ->andFilterWhere(['like', 'link_tiktok', $this->link_tiktok])
                ->andFilterWhere(['like', 'profile_picture', $this->profile_picture]);

        return $dataProvider;
    }

}
