<?php
/** @var \common\models\Order $order */

$customerAddress = $order->customerAddress;
?>

Order #<?php echo $order->id ?> summary;

Account information
    Firstname: <?php echo $order->firstname ?>
    Lastname: <?php echo $order->lastname ?>
    Email: <?php echo $order->email ?>

Address information
    Address: <?php echo $customerAddress->address ?>
    City: <?php echo $customerAddress->city ?>
    State: <?php echo $customerAddress->state ?>
    Country: <?php echo $customerAddress->country ?>

Products   
    Name    Quantity    Price
<?php foreach($order->orderItems as $item): ?>
    <?php echo $item->product_name ?>  <?php echo $item->quantity ?>    <?php echo Yii::$app->formatter->asCurrency($item->quantity * $item->unit_price) ?>
<?php endforeach; ?>
Total Items: <?php echo $order->getItemsQuantity() ?>
Total Price: <?php echo Yii::$app->formatter->asCurrency($order->total_price) ?>