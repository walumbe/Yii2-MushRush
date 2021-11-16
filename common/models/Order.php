<?php

namespace common\models;

use Exception;
use Yii;

/**
 * This is the model class for table "{{%orders}}".
 *
 * @property int $id
 * @property float $total_price
 * @property int $status
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string|null $transaction_id
 * @property string|null $paypal_order_id
 * @property int|null $created_at
 * @property int|null $created_by
 *
 * @property User $createdBy
 * @property CustomerAddress $customerAddress
 * @property OrderItems[] $orderItems
 * @property User $created_by
 */
class Order extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_COMPLETED = 1;
    const STATUS_INCOMPLETE = 2;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%orders}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['total_price', 'status', 'firstname', 'lastname', 'email'], 'required'],
            [['total_price'], 'number'],
            [['status', 'created_at', 'created_by'], 'integer'],
            [['firstname', 'lastname'], 'string', 'max' => 45],
            [['email', 'transaction_id', 'paypal_order_id'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'total_price' => 'Total Price',
            'status' => 'Status',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'email' => 'Email',
            'transaction_id' => 'Transaction ID',
            'paypal_order_id' => 'Paypal Order ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\Query\UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[CustomerAddress]].
     *
     * @return \yii\db\ActiveQuery|\common\models\Query\CustomerAddressQuery
     */
    public function getCustomerAddress()

    {
        return $this->hasOne(CustomerAddress::className(), ['customer_id' => 'id']);
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery|\common\models\Query\OrderItemsQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['order_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Query\OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\Query\OrderQuery(get_called_class());
    }

    public function saveAddress($postData)
    {
            $customerAddress = new CustomerAddress();
            $customerAddress->customer_id = $this->id;
            if($customerAddress->load($postData) && $customerAddress->save()){
                return true;
            }
            throw new Exception("Could not save customer address: ".implode("<br>", $customerAddress->getFirstErrors()));
    }

    public function saveOrderItems()
    {
        // $transaction = Yii::$app->db->beginTransaction();
        $cartItems = CartItem::getItemsForUser(currentUserId());
       foreach($cartItems as $cartItem){
           $orderItem = new OrderItem();
           $orderItem->product_name = $cartItem['name'];
           $orderItem->product_id = $cartItem['id'];
           $orderItem->unit_price = $cartItem['price'];
           $orderItem->order_id = $this->id;
           $orderItem->quantity = $cartItem['quantity'];
           $orderItem->created_by = currentUserId();
           if(!$orderItem->save()){
            //    $transaction->rollBack();s
            //    returns the first errors for each attribute
               throw new Exception("Order item was not saved!".implode('<br>', $orderItem->getFirstErrors()));
               break;
           }
       }
    //    $transaction->commit();
       return true;
    }

    public function getItemsQuantity()
    {
        return $sum = CartItem::findBySql(
            "SELECT SUM(quantity) FROM order_items WHERE order_id = :orderId", ['orderId' => $this->id]
        )->scalar();
    }
}
