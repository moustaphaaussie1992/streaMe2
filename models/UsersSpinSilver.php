<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users_spin_silver".
 *
 * @property int $id
 * @property int $userId
 * @property int $prizedId
 * @property string $date
 *
 * @property Prizes $prized
 * @property Users $user
 */
class UsersSpinSilver extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_spin_silver';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'prizedId'], 'required'],
            [['userId', 'prizedId'], 'integer'],
            [['date'], 'safe'],
            [['prizedId'], 'exist', 'skipOnError' => true, 'targetClass' => Prizes::className(), 'targetAttribute' => ['prizedId' => 'id']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'userId' => Yii::t('app', 'User ID'),
            'prizedId' => Yii::t('app', 'Prized ID'),
            'date' => Yii::t('app', 'Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrized()
    {
        return $this->hasOne(Prizes::className(), ['id' => 'prizedId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'userId']);
    }
}
