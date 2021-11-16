<?php

/** @var \common\models\Order $order */

$customerAddress = $order->customerAddress;

?>
<style>
    .row{
        display: flex;
    }
    col{
        flex: 1;
    }
</style>
<h3>Order #<?php echo $order->id ?> summary: </h3>
<hr>
<div class="row">
    <div class="col">
        <h5>Account Information</h5>
        <table class="table">
            <tr>
                <th>Firstname</th>
                <td><?php echo $order->firstname ?></td>
            </tr>
            <tr>
                <th>Lastname</th>
                <td><?php echo $order->lastname ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $order->email ?></td>
            </tr>
        </table>
        <h5>Address Information</h5>
        <table class="table">
            <tr>
                <th>Address</th>
                <td><?php echo $customerAddress->address ?></td>
            </tr>
            <tr>
                <th>City</th>
                <td><?php echo $customerAddress->city ?></td>
            </tr>
            <tr>
                <th>State</th>
                <td><?php echo $customerAddress->state ?></td>
            </tr>
            <tr>
                <th>Country</th>
                <td><?php echo $customerAddress->country ?></td>
            </tr>
        </table>
    </div>
    <div class="col">
        <h5>Products</h5>
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
                <?php foreach($order->orderItems as $item): ?>
                    <tr>
                        <td>
                            <img src="<?php echo $item->product->getImageUrl(); ?>" alt="" style="width: 50px">
                        </td>
                        <td><?php echo $item->poduct_name ?></td>
                        <td><?php echo $item->quantity ?></td>
                        <td><?php echo Yii::$app->formatter->asCurrency($item->quantity * $iten->unit_price) ?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <hr>
        <table class="table">
            <tr>
                <th>Total Items</th>
                <td><?php echo $order->getItemsQuantity() ?></td>
            </tr>
            <tr>
                <th>Total Price</th>
                <td><?php echo Yii::$app->formatter->asCurrency($order->total_price) ?></td>
            </tr>
        </table>
    </div>
</div>