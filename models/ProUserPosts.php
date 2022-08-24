<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pro_user_posts".
 *
 * @property int $id
 * @property int $user_id
 * @property string $creation_date
 * @property string $type
 * @property string $image
 * @property string $video
 * @property string $text
 */
class ProUserPosts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pro_user_posts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['creation_date'], 'safe'],
            [['type', 'image', 'video', 'text'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'creation_date' => Yii::t('app', 'Creation Date'),
            'type' => Yii::t('app', 'Type'),
            'image' => Yii::t('app', 'Image'),
            'video' => Yii::t('app', 'Video'),
            'text' => Yii::t('app', 'Text'),
        ];
    }
}
