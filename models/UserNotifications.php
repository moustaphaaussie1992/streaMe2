<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_notifications".
 *
 * @property int $id
 * @property int $number_remaining
 * @property int $number_remaining_for_all_users
 * @property int $user_id
 * @property string|null $product_name
 */
class UserNotifications extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_notifications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number_remaining', 'user_id'], 'required'],
            [['number_remaining', 'number_remaining_for_all_users', 'user_id'], 'integer'],
            [['product_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number_remaining' => 'Number Remaining',
            'number_remaining_for_all_users' => 'Number Remaining For All Users',
            'user_id' => 'User ID',
            'product_name' => 'Product Name',
        ];
    }
}
