<?php 
/** @var \common\models\Order $order */

use yii\bootstrap4\ActiveForm;

/** @var \common\models\CustomerAddress $customerAddress */
/** @var array $cartItems */
/** @var int $productQuantity */
/** @var float $totalPrice */

?>


 <?php $form = ActiveForm::begin([
    'id' => 'checkout-form',
    // 'action' => ['/cart/submit-order']
]); ?>

<div class="row">
    <div class="col">
        <div class="card mb-3">
            <div class="card-header">
                <h5>Account information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($order, 'firstname')->textInput(['autofocus' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($order, 'lastname')->textInput(['autofocus' => true]) ?>
                    </div>
                </div>
                <?= $form->field($order, 'email')->textInput(['autofocus' => true]) ?>

            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>Address information</h5>
            </div>
            <div class="card-body">
                <?= $form->field($customerAddress, 'customer_address') ?>
                <?= $form->field($customerAddress, 'city') ?>
                <?= $form->field($customerAddress, 'state') ?>
                <?= $form->field($customerAddress, 'country') ?>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h5>Order Summary</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($cartItems as $item): ?>
                        <tr >
                            <td>
                                <img src="<?php echo \common\models\Product::formatImageUrl($item['image']) ?>"
                                     style="width: 50px;"
                                     alt="<?php echo $item['name'] ?>">
                            </td>
                            <td><?php echo $item['name'] ?></td>
                            <td>
                                <?php echo $item['quantity'] ?>
                            </td>
                            <td><?php echo Yii::$app->formatter->asCurrency($item['total_price']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <hr>
                <table class="table">
                    <tr>
                        <td>Total Items</td>
                        <td class="text-right"><?php  echo $productQuantity ?></td>
                    </tr>
                    <tr>
                        <td>Total Price</td>
                        <td class="text-right">
                            <?php echo Yii::$app->formatter->asCurrency($totalPrice) ?>
                        </td>
                    </tr>
                </table>
                <!-- <div id="paypal-button-container"></div> -->
                <p class="text-right mt-3">
                    <button class="btn btn-secondary">Checkout</button>
                </p>
            </div>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>

