<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pageadmin".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $link
 * @property string $fullname
 * @property int $pubgid
 *
 * @property Follow[] $follows
 * @property Rooms[] $rooms
 */
class Pageadmin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pageadmin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'link', 'fullname', 'pubgid'], 'required'],
            [['pubgid'], 'integer'],
            [['username', 'password', 'link', 'fullname'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'link' => 'Link',
            'fullname' => 'Fullname',
            'pubgid' => 'Pubgid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFollows()
    {
        return $this->hasMany(Follow::className(), ['r_page' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Rooms::className(), ['r_admin' => 'id']);
    }
}
