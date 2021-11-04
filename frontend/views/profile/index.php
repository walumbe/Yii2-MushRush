<?php

/**
 * @var \common\models\User $user
 * @var \yii\web\View $this
 *   @var \common\models\UserAddress $userAddress
 */

 ?>
 <div class="row">
     <div class="col">
      <div class="card">
          <div class="card-header">
              Address Information
          </div>
          <div class="card-body">
          <?php \yii\widgets\Pjax::begin([
                'enablePushState' => false
            ]) ?>
            <?php echo $this->render('user_address', [
                'userAddress' => $userAddress
            ]) ?>
            <?php \yii\widgets\Pjax::end() ?>
          </div>
      </div>
     </div>
     <div class="col">
        <div class="card">
            <div class="card-header">
                Account Information
            </div>
            <div class="card-body">
            <?php \yii\widgets\Pjax::begin([
                'enablePushState' => false
            ]) ?>
             <?php echo $this->render('user_account', [
                    'user' => $user 
                ]); ?>
                <?php \yii\widgets\Pjax::end() ?>
            </div>
        </div>
     </div>

 </div>