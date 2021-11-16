<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%customer_address}}".
 *
 * @property int $customer_id
 * @property string $customer_address
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $created_by
 *
 * @property Orders $order
 */
class CustomerAddress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%customer_address}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'customer_address', 'city', 'state', 'country'], 'required'],
            [['customer_id'], 'integer'],
            [['customer_address', 'city', 'state', 'country'], 'string', 'max' => 255],
            [['customer_id'], 'unique'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'customer_id' => 'Customer ID',
            'customer_address' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'country' => 'Country',
        ];
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery|\common\models\Query\OrderQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'customer_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Query\CustomerAddressQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\Query\CustomerAddressQuery(get_called_class());
    }
}
