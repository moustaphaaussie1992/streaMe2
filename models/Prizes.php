<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prizes".
 *
 * @property int $id
 * @property string $prizeName
 *
 * @property UsersSpinSilver[] $usersSpinSilvers
 */
class Prizes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prizes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prizeName'], 'required'],
            [['prizeName'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'prizeName' => Yii::t('app', 'Prize Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersSpinSilvers()
    {
        return $this->hasMany(UsersSpinSilver::className(), ['prizedId' => 'id']);
    }
}
