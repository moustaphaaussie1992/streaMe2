<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pro_user_posts_views".
 *
 * @property int $id
 * @property int $user_id
 * @property int $pro_post_id
 * @property string $creation_date
 *
 * @property ProUserPosts $proPost
 * @property Users $user
 */
class ProUserPostsViews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pro_user_posts_views';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'pro_post_id'], 'required'],
            [['user_id', 'pro_post_id'], 'integer'],
            [['creation_date'], 'safe'],
            [['user_id', 'pro_post_id'], 'unique', 'targetAttribute' => ['user_id', 'pro_post_id']],
            [['pro_post_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProUserPosts::className(), 'targetAttribute' => ['pro_post_id' => 'id']],
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
            'pro_post_id' => 'Pro Post ID',
            'creation_date' => 'Creation Date',
        ];
    }

    /**
     * Gets query for [[ProPost]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProPost()
    {
        return $this->hasOne(ProUserPosts::className(), ['id' => 'pro_post_id']);
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
