<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rooms;

/**
 * RoomsSearch represents the model behind the search form of `app\models\Rooms`.
 */
class RoomsSearch extends Rooms {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'r_admin', 'game', 'mention', 'mention2', 'mention3', 'accept1', 'accept2', 'accept3', 'challenge_coins', 'is_challenge_finished', 'challenge_winner', 'streamer_response', 'invitation_response'], 'integer'],
            [['title', 'c_text', 'creation_date', 'type', 'category', 'color1', 'color2', 'video_thumbnail', 'challenge_date'], 'safe'],
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
    public function search($params)
    {
        $query = Rooms::find();

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
            'r_admin' => $this->r_admin,
            'creation_date' => $this->creation_date,
            'game' => $this->game,
            'mention' => $this->mention,
            'mention2' => $this->mention2,
            'mention3' => $this->mention3,
            'accept1' => $this->accept1,
            'accept2' => $this->accept2,
            'accept3' => $this->accept3,
            'challenge_coins' => $this->challenge_coins,
            'is_challenge_finished' => $this->is_challenge_finished,
            'challenge_winner' => $this->challenge_winner,
            'streamer_response' => $this->streamer_response,
            'invitation_response' => $this->invitation_response,
            'challenge_date' => $this->challenge_date,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'c_text', $this->c_text])
                ->andFilterWhere(['like', 'type', $this->type])
                ->andFilterWhere(['like', 'category', $this->category])
                ->andFilterWhere(['like', 'color1', $this->color1])
                ->andFilterWhere(['like', 'color2', $this->color2])
                ->andFilterWhere(['like', 'video_thumbnail', $this->video_thumbnail]);

        return $dataProvider;
    }

}
