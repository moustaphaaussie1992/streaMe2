<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "streamer_games".
 *
 * @property int $id
 * @property int $user_id
 * @property int $game_id
 * @property string $game_account_id
 *
 * @property Games $game
 * @property Users $user
 */
class StreamerGames extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'streamer_games';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'game_id', 'game_account_id'], 'required'],
            [['user_id', 'game_id'], 'integer'],
            [['game_account_id'], 'string', 'max' => 50],
            [['user_id', 'game_id'], 'unique', 'targetAttribute' => ['user_id', 'game_id']],
            [['game_id'], 'exist', 'skipOnError' => true, 'targetClass' => Games::className(), 'targetAttribute' => ['game_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'game_id' => 'Game ID',
            'game_account_id' => 'Game Account ID',
        ];
    }

    /**
     * Gets query for [[Game]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGame()
    {
        return $this->hasOne(Games::className(), ['id' => 'game_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
