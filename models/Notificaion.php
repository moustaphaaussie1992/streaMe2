<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notificaion".
 *
 * @property int $id
 * @property int $room_id
 * @property string $description
 * @property int $sender_id
 * @property int $reciever_id
 * @property int $is_read
 * @property string $date
 *
 * @property Users $reciever
 * @property Users $sender
 * @property Rooms $room
 */
class Notificaion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notificaion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['room_id', 'sender_id', 'reciever_id', 'is_read'], 'integer'],
            [['date'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['reciever_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['reciever_id' => 'id']],
            [['sender_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['sender_id' => 'id']],
            [['room_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rooms::className(), 'targetAttribute' => ['room_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'room_id' => 'Room ID',
            'description' => 'Description',
            'sender_id' => 'Sender ID',
            'reciever_id' => 'Reciever ID',
            'is_read' => 'Is Read',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReciever()
    {
        return $this->hasOne(Users::className(), ['id' => 'reciever_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSender()
    {
        return $this->hasOne(Users::className(), ['id' => 'sender_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Rooms::className(), ['id' => 'room_id']);
    }
}
