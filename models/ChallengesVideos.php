<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "challenges_videos".
 *
 * @property int $id
 * @property int $post_id
 * @property string $file_name
 * @property int $streamer_id
 * @property string|null $thumbnail
 * @property string $creation_date
 *
 * @property Rooms $post
 * @property Users $streamer
 */
class ChallengesVideos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'challenges_videos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id', 'file_name', 'streamer_id'], 'required'],
            [['post_id', 'streamer_id'], 'integer'],
            [['creation_date'], 'safe'],
            [['file_name'], 'string', 'max' => 255],
            [['thumbnail'], 'string', 'max' => 200],
            [['post_id', 'streamer_id'], 'unique', 'targetAttribute' => ['post_id', 'streamer_id']],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rooms::className(), 'targetAttribute' => ['post_id' => 'id']],
            [['streamer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['streamer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'file_name' => 'File Name',
            'streamer_id' => 'Streamer ID',
            'thumbnail' => 'Thumbnail',
            'creation_date' => 'Creation Date',
        ];
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
     * Gets query for [[Streamer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStreamer()
    {
        return $this->hasOne(Users::className(), ['id' => 'streamer_id']);
    }
}
