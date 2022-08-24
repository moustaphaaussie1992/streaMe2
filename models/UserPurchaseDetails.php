<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_purchase_details".
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $orderId
 * @property string|null $packageName
 * @property string|null $productId
 * @property string|null $purchaseTime
 * @property string|null $purchaseState
 * @property string|null $purchaseToken
 * @property string|null $quantity
 * @property string|null $acknowledged
 * @property string|null $creation_date
 */
class UserPurchaseDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_purchase_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['creation_date'], 'safe'],
            [['orderId', 'packageName', 'productId', 'purchaseTime', 'purchaseState', 'purchaseToken', 'quantity', 'acknowledged'], 'string', 'max' => 200],
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
            'orderId' => 'Order ID',
            'packageName' => 'Package Name',
            'productId' => 'Product ID',
            'purchaseTime' => 'Purchase Time',
            'purchaseState' => 'Purchase State',
            'purchaseToken' => 'Purchase Token',
            'quantity' => 'Quantity',
            'acknowledged' => 'Acknowledged',
            'creation_date' => 'Creation Date',
        ];
    }
}
