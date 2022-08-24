<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "follow".
 *
 * @property int $id
 * @property int $r_user
 * @property int $r_page
 *
 * @property Users $rPage
 * @property Users $rUser
 */
class Follow extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'follow';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['r_user', 'r_page'], 'required'],
            [['r_user', 'r_page'], 'integer'],
            [['r_user', 'r_page'], 'unique', 'targetAttribute' => ['r_user', 'r_page']],
            [['r_page'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['r_page' => 'id']],
            [['r_user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['r_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'r_user' => 'R User',
            'r_page' => 'R Page',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRPage() {
        return $this->hasOne(Users::className(), ['id' => 'r_page']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRUser() {
        return $this->hasOne(Users::className(), ['id' => 'r_user']);
    }

}
