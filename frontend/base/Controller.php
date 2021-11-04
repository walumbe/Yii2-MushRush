<?php
namespace frontend\base;

use common\models\CartItem;

/**
 * @package frontend\base
 */
class Controller extends \yii\web\Controller
{
    public function beforeAction($action)
    {
       
        $this->view->params['cartItemCount']  = CartItem::getTotalQuantityForUser(currentUserId());
       return parent::beforeAction($action);
    }
}