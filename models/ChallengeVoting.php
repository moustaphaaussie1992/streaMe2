<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "challenge_voting".
 *
 * @property int $id
 * @property int $r_user
 * @property int $post_id
 * @property int $r_streamer_voted
 *
 * @property Users $rUser
 * @property Rooms $post
 * @property Users $rStreamerVoted
 */
class ChallengeVoting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'challenge_voting';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['r_user', 'post_id', 'r_streamer_voted'], 'required'],
            [['r_user', 'post_id', 'r_streamer_voted'], 'integer'],
            [['r_user', 'post_id'], 'unique', 'targetAttribute' => ['r_user', 'post_id']],
            [['r_user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['r_user' => 'id']],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rooms::className(), 'targetAttribute' => ['post_id' => 'id']],
            [['r_streamer_voted'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['r_streamer_voted' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'r_user' => 'R User',
            'post_id' => 'Post ID',
            'r_streamer_voted' => 'R Streamer Voted',
        ];
    }

    /**
     * Gets query for [[RUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'r_user']);
    }

    /**
     * Gets query for [[Post]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Rooms::className(), ['id' => 'post_id']);
    }

    /**
     * Gets query for [[RStreamerVoted]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRStreamerVoted()
    {
        return $this->hasOne(Users::className(), ['id' => 'r_streamer_voted']);
    }
}
