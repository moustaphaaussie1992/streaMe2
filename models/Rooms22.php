<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rooms".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $c_text
 * @property int $r_admin
 * @property string|null $creation_date
 * @property string|null $type
 * @property int|null $game
 * @property string|null $category
 * @property int|null $mention
 * @property int|null $mention2
 * @property int|null $mention3
 * @property int $accept1
 * @property int $accept2
 * @property int $accept3
 * @property string|null $color1
 * @property string|null $color2
 * @property string|null $video_thumbnail
 * @property int|null $challenge_coins
 * @property int|null $is_challenge_finished
 * @property int|null $challenge_user_result
 * @property int|null $streamer_response
 * @property int|null $invitation_response
 * @property string|null $challenge_date
 *
 * @property ChallengeVoting[] $challengeVotings
 * @property Users[] $rUsers
 * @property ChallengesVideos[] $challengesVideos
 * @property Users[] $streamers
 * @property Comment[] $comments
 * @property Followrooms[] $followrooms
 * @property PostFiles[] $postFiles
 * @property Users $rAdmin
 * @property Users $mention0
 * @property Games $game0
 * @property Users $mention20
 * @property Users $mention30
 */
class Rooms extends \yii\db\ActiveRecord {

    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'rooms';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['c_text'], 'string'],
            [['r_admin'], 'required'],
            [['r_admin', 'game', 'mention', 'mention2', 'mention3', 'accept1', 'accept2', 'accept3', 'challenge_coins', 'is_challenge_finished', 'challenge_winner', 'streamer_response', 'invitation_response'], 'integer'],
            [['creation_date', 'challenge_date'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 50],
            [['file'], 'file', 'skipOnEmpty' => true,
                'extensions' => 'png,jpg',
                'maxFiles' => 5,
            ],
            [['category', 'video_thumbnail'], 'string', 'max' => 200],
            [['color1', 'color2'], 'string', 'max' => 20],
            [['r_admin'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['r_admin' => 'id']],
            [['mention'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['mention' => 'id']],
            [['game'], 'exist', 'skipOnError' => true, 'targetClass' => Games::className(), 'targetAttribute' => ['game' => 'id']],
            [['mention2'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['mention2' => 'id']],
            [['mention3'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['mention3' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'c_text' => 'C Text',
            'r_admin' => 'R Admin',
            'creation_date' => 'Creation Date',
            'type' => 'Type',
            'game' => 'Game',
            'category' => 'Category',
            'mention' => 'Mention',
            'mention2' => 'Mention2',
            'mention3' => 'Mention3',
            'accept1' => 'Accept1',
            'accept2' => 'Accept2',
            'accept3' => 'Accept3',
            'color1' => 'Color1',
            'color2' => 'Color2',
            'video_thumbnail' => 'Video Thumbnail',
            'challenge_coins' => 'Challenge Coins',
            'is_challenge_finished' => 'Challenge Result',
            'challenge_winner' => 'Challenge User Result',
            'streamer_response' => 'Streamer Response',
            'invitation_response' => 'Invitation Response',
            'challenge_date' => 'Challenge Date',
        ];
    }

    /**
     * Gets query for [[ChallengeVotings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChallengeVotings() {
        return $this->hasMany(ChallengeVoting::className(), ['post_id' => 'id']);
    }

    /**
     * Gets query for [[RUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRUsers() {
        return $this->hasMany(Users::className(), ['id' => 'r_user'])->viaTable('challenge_voting', ['post_id' => 'id']);
    }

    /**
     * Gets query for [[ChallengesVideos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChallengesVideos() {
        return $this->hasMany(ChallengesVideos::className(), ['post_id' => 'id']);
    }

    /**
     * Gets query for [[Streamers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStreamers() {
        return $this->hasMany(Users::className(), ['id' => 'streamer_id'])->viaTable('challenges_videos', ['post_id' => 'id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments() {
        return $this->hasMany(Comment::className(), ['r_room' => 'id']);
    }

    /**
     * Gets query for [[Followrooms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFollowrooms() {
        return $this->hasMany(Followrooms::className(), ['r_room' => 'id']);
    }

    /**
     * Gets query for [[PostFiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPostFiles() {
        return $this->hasMany(PostFiles::className(), ['post_id' => 'id']);
    }

    /**
     * Gets query for [[RAdmin]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRAdmin() {
        return $this->hasOne(Users::className(), ['id' => 'r_admin']);
    }

    /**
     * Gets query for [[Mention0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMention0() {
        return $this->hasOne(Users::className(), ['id' => 'mention']);
    }

    /**
     * Gets query for [[Game0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGame0() {
        return $this->hasOne(Games::className(), ['id' => 'game']);
    }

    /**
     * Gets query for [[Mention20]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMention20() {
        return $this->hasOne(Users::className(), ['id' => 'mention2']);
    }

    /**
     * Gets query for [[Mention30]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMention30() {
        return $this->hasOne(Users::className(), ['id' => 'mention3']);
    }

}
