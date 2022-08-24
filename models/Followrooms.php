<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "followrooms".
 *
 * @property int $id
 * @property int $r_room
 * @property int $r_user
 *
 * @property Rooms $rRoom
 * @property Users $rUser
 */
class Followrooms extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'followrooms';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['r_room', 'r_user', 'user_token'], 'required'],
            [['r_room', 'r_user'], 'integer'],
            [['r_room'], 'exist', 'skipOnError' => true, 'targetClass' => Rooms::className(), 'targetAttribute' => ['r_room' => 'id']],
            [['r_user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['r_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'r_room' => 'R Room',
            'r_user' => 'R User',
            'user_token' => 'User Token'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRRoom() {
        return $this->hasOne(Rooms::className(), ['id' => 'r_room']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRUser() {
        return $this->hasOne(Users::className(), ['id' => 'r_user']);
    }

}
