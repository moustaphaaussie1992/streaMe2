<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_transactions".
 *
 * @property int $id
 * @property int $userId
 * @property int $fromUser
 * @property int|null $roomId
 * @property int $coins
 * @property string $type
 * @property string $date
 *
 * @property Users $user
 * @property Users $fromUser0
 * @property Rooms $room
 */
class UserTransactions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_transactions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fromUser', 'coins', 'type'], 'required'],
            [[ 'userId', 'fromUser', 'roomId', 'coins'], 'integer'],
            [['date'], 'safe'],
            [['type'], 'string', 'max' => 255],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['userId' => 'id']],
            [['fromUser'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['fromUser' => 'id']],
            [['roomId'], 'exist', 'skipOnError' => true, 'targetClass' => Rooms::className(), 'targetAttribute' => ['roomId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userId' => 'User ID',
            'fromUser' => 'From User',
            'roomId' => 'Room ID',
            'coins' => 'Coins',
            'type' => 'Type',
            'date' => 'Date',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'userId']);
    }

    /**
     * Gets query for [[FromUser0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFromUser0()
    {
        return $this->hasOne(Users::className(), ['id' => 'fromUser']);
    }

    /**
     * Gets query for [[Room]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Rooms::className(), ['id' => 'roomId']);
    }
}
