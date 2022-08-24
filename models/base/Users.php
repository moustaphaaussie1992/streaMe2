<?php

namespace app\models\base;

use mdm\admin\models\User;
use Yii;

/**
 * This is the model class for table "users".
 *
 * 	* @property string $phone
 * @property string $email
 * @property string $address
 * @property string $birthday
 * @property string $gender
 * @property string $work
 * @property string $hashtags
 * @property int $id
 * @property int $role
 * @property string $fullname
 * @property string $password
 * @property string $username
 * @property int $role

 * @property int $is_approved
 * @property int $coins
 * @property string|null $token
 * @property string|null $link_facebook
 * @property string|null $link_youtube
 * @property string|null $link_instagram
 * @property string|null $link_tiktok
 * @property string|null $profile_picture
 *
 * @property Comment[] $comments
 * @property Follow[] $follows
 * @property Follow[] $follows0
 * @property Followrooms[] $followrooms
 * @property Rooms[] $rooms
 * @property StreamerGames[] $streamerGames
 * @property Games[] $games
 */
class Users extends User {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['fullname', 'password', 'username'], 'required'],
            [['password'], 'string'],
            [['role', 'is_approved', 'role', 'status'], 'integer'],
            [['fullname', 'link_facebook', 'link_youtube', 'link_instagram', 'link_tiktok'], 'string', 'max' => 200],
            [['username'], 'string', 'max' => 100],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 256],
            [['token'], 'string', 'max' => 300],
            [['profile_picture'], 'string', 'max' => 2000],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'fullname' => Yii::t('app', 'Fullname'),
            'password' => Yii::t('app', 'Password'),
            'username' => Yii::t('app', 'Username'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'address' => Yii::t('app', 'Address'),
            'birthday' => Yii::t('app', 'Birthday'),
            'gender' => Yii::t('app', 'Gender'),
            'work' => Yii::t('app', 'Work'),
            'hashtags' => Yii::t('app', 'Hashtags'),
            'role' => Yii::t('app', 'Role'),
            'token' => Yii::t('app', 'Token'),
            'link_facebook' => Yii::t('app', 'Link Facebook'),
            'link_youtube' => Yii::t('app', 'Link Youtube'),
            'link_instagram' => Yii::t('app', 'Link Instagram'),
            'link_tiktok' => Yii::t('app', 'Link Tiktok'),
            'profile_picture' => Yii::t('app', 'Profile Picture'),
            'is_approved' => Yii::t('app', 'Is Approved'),
            'coins' => Yii::t('app', 'Coins'),
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments() {
        return $this->hasMany(Comment::className(), ['r_user' => 'id']);
    }

    /**
     * Gets query for [[Follows]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFollows() {
        return $this->hasMany(Follow::className(), ['r_page' => 'id']);
    }

    /**
     * Gets query for [[Follows0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFollows0() {
        return $this->hasMany(Follow::className(), ['r_user' => 'id']);
    }

    /**
     * Gets query for [[Followrooms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFollowrooms() {
        return $this->hasMany(Followrooms::className(), ['r_user' => 'id']);
    }

    /**
     * Gets query for [[Rooms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRooms() {
        return $this->hasMany(Rooms::className(), ['r_admin' => 'id']);
    }

    /**
     * Gets query for [[StreamerGames]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStreamerGames() {
        return $this->hasMany(StreamerGames::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Games]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGames() {
        return $this->hasMany(Games::className(), ['id' => 'game_id'])->viaTable('streamer_games', ['user_id' => 'id']);
    }

}
