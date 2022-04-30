<?php 
namespace backend\models;

use common\models\User;
use yii;
use yii\base\Model;

class LoginForm
{
    /**
     * Finds user by [[username]]
     * 
     * return User|null
     */

     protected function getUser()
     {
         if($this->_user === null)
         {
             $this->_user = user::findOne([
                 'username' => $this->username,
                 'status' => User::STATUS_ACTIVE,
                 'admin' => 1
             ]);
         }
     }
}