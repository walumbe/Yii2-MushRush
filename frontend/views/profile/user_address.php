<?php
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
/**
 * @var \yii\web\View $this
 * @var \common\models\UserAddress $userAddress
 */
?>

<?php if (isset($success) && $success) { ?>
  <div class="alert alert-success">
    Your Address was Successfully Updated!  
  </div>
<?php } ?>
<?php $addressForm = ActiveForm::begin([
        'action' => ['/profile/update-address'],
        'options' => [
            'data-pjax' => 1
        ]
        ]); ?>
    <?= $addressForm ->field($userAddress, 'address')?>
    <?= $addressForm ->field($userAddress, 'city')?>
    <?= $addressForm ->field($userAddress, 'state')?>
    <?= $addressForm ->field($userAddress, 'country')?>
    <?= $addressForm ->field($userAddress, 'zipcode')?>
    <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end() ?>