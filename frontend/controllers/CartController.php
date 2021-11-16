<?php
namespace frontend\controllers;

use common\models\CartItem;
use common\models\Order;
use common\models\CustomerAddress;
use common\models\Product;
use Exception;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;
use Yii;
use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;


class CartController extends \frontend\base\Controller
{

    public function behaviors()
    {
        return [
           [
            'class' => ContentNegotiator::class,
            'only' => ['add', 'create-order','submit-payment', 'change-quantity'],
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ],
        [
            'class' => VerbFilter::class,
            'actions' => [
                'Delete' => ['POST', 'DELETE'],
                'create-order' => ['POST'],
            ]
        ]
        ];
    }
    public function actionIndex()
    { 
        $cartItems = CartItem::getItemsForUser(currentUserId());

        return $this->render('index',[
            'items' => $cartItems
        ]);
    }

    public function actionAdd()
    {
        $id = \Yii::$app->request->post('id');
        // $product = Product::findOne(['id' => $id, 'status' => 1]);
        $product = Product::find()->id($id)->published()->one();
        if(!$product)
        {
            throw new NotFoundHttpException('Product does not exist');
        }
        if(\Yii::$app->user->isGuest)
        {
            // save in session
            $cartItems = \Yii::$app->session->get(CartItem::SESSION_KEY, []);
            $found = false;
            foreach ($cartItems as &$item) {
                if ($item['id'] == $id) {
                    $item['quantity']++;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $cartItem = [
                    'id' => $id,
                    'name' => $product->name,
                    'image' => $product->image,
                    'price' => $product->price,
                    'quantity' => 1,
                    'total_price' => $product->price,
                ];
                $cartItems[] = $cartItem;
            }
           
            \Yii::$app->session->set(CartItem::SESSION_KEY, $cartItems);
        }else {
            $id = \Yii::$app->request->post('id');
            $userId = \Yii::$app->user->id;
            $cartItem = CartItem::find()->userId($userId)->productId($id)->one();
            if($cartItem) {
                $cartItem->quantity++;
            } else {
                $cartItem = new CartItem();
                $cartItem->product_id = $id;
                $cartItem->created_by = \Yii::$app->user->id;
                $cartItem->quantity = 1;
            }
    
            if($cartItem->save()){
                return [
                    'success' => true
                ];
            } else {
                return [
                    'success' => false,
                    'errors' => $cartItem->errors
                ];
            }
        }
    }

    public function actionDelete($id)
    {
        if(isGuest())
        {
            $cartItems = \Yii::$app->session->get(CartItem::SESSION_KEY, []);
            foreach ($cartItems as $i => $cartItem){
                if($cartItem['id'] == $id){
                    array_splice($cartItems, $i, 1);
                    break;
                }
            }
            \Yii::$app->session->set(CartItem::SESSION_KEY, $cartItems);
        } else {
            CartItem::deleteAll(['product_id' => $id, 'created_by' => currentUserId() ]);
        }
        return $this->redirect(['index']);
    }

    public function actionChangeQuantity()
    {
        $id = \Yii::$app->request->post('id');
        $product = Product::find()->id($id)->published()->one();
        if (!$product) {
            throw new NotFoundHttpException("Product does not exist");
        }
        $quantity = \Yii::$app->request->post('quantity');
        if (isGuest()) {
            $cartItems = \Yii::$app->session->get(CartItem::SESSION_KEY, []);
            foreach ($cartItems as &$cartItem) {
                if ($cartItem['id'] === $id) {
                    $cartItem['quantity'] = $quantity;
                    break;
                }
            }
            \Yii::$app->session->set(CartItem::SESSION_KEY, $cartItems);
        } else {
            $cartItem = CartItem::find()->userId(currentUserId())->productId($id)->one();
            if ($cartItem) {
                $cartItem->quantity = $quantity;
                $cartItem->save();
            }
        }

        return CartItem::getTotalQuantityForUser(currentUserId());
     
    }

    public function actionCheckout()
    {
        $cartItems = CartItem::getItemsForUser(currentUserId());
        $productQuantity = CartItem::getTotalQuantityForUser(currentUserId());
        $totalPrice = CartItem::getTotalPriceForUser(currentUserId());
       
        if(empty($cartItems)){
            return $this->redirect([Yii::$app->homeUrl]);
        }
        $order = new Order();
        $order->total_price = $totalPrice;
        $order->status = Order::STATUS_INACTIVE;
        $order->created_at = time();
        $order->created_by = currentUserId();
        $transaction = Yii::$app->db->beginTransaction();
        if($order->load(Yii::$app->request->post())
            && $order->save()
            && $order->saveAddress(Yii::$app->request->post())
            && $order->saveOrderItems()){
                $transaction->commit();

                CartItem::clearCartItems(currentUserId());

                return $this->render('pay-now', [
                    'order' => $order,
                    // 'customerAddress' => $order->customerAddress,
                    // 'cartItems' => $cartItems,
                    // 'productQuantity' => $productQuantity,
                    // 'totalPrice' => $totalPrice
                ]);
                
        }
       
        $customerAddress = new CustomerAddress();
        if(!isGuest())
        {
             /** @var \common\models\User $user */
            $user = Yii::$app->user->identity;
            $userAddress = $user->getAddress();
            $order->firstname = $user->firstname;
            $order->lastname = $user->lastname;
            $order->email = $user->email;
            $order->status = order::STATUS_INACTIVE;

            $customerAddress->customer_address = $userAddress->address;
            $customerAddress->city = $userAddress->city;
            $customerAddress->state = $userAddress->state;
            $customerAddress->country = $userAddress->country;
            $customerAddress->created_by = currentUserId();

        }

        return $this->render('checkout', [
            'order' => $order,
            'customerAddress' => $customerAddress,
            'cartItems' => $cartItems,
            'productQuantity' => $productQuantity,
            'totalPrice' => $totalPrice,
        ]);
        
    }
    public function actionSubmitPayment($orderId)
    {
        $where = ['id' => $orderId, 'status' => Order::STATUS_INACTIVE];
        if(!isGuest())
        {
            $where['created_by'] = currentUserId();
        }
        $order = Order::findOne($where);
        if(!$order)
        {
            throw new NotFoundHttpException();
        }
        $req = Yii::$app->request;
        $paypalOrderId = $req->post('orderId');
        $exists = Order::find()->andWhere(['paypal_order_id' => $paypalOrderId])->exists();
        if ($exists) {
            throw new BadRequestHttpException();
        }

        $environment = new SandboxEnvironment(Yii::$app->params['paypalClientId'], Yii::$app->params['paypalSecret']);
        $client = new PayPalHttpClient($environment);

        try {
            $response = $client->execute(new OrdersGetRequest($paypalOrderId));
            var_dump($response);
        }
        catch(Exception $ex){
            echo $ex->statusCode;
            var_dump($ex->getMessage());
        }
        

        if($response->statusCode === 200){
            $order->paypal_order_id = $paypalOrderId;
            $paidAmount = 0;
            foreach ($response->result->purchase_units as $purchase_unit) {
                if ($purchase_unit->amount->currency_code === 'USD') {
                    $paidAmount += $purchase_unit->amount->value;
                }
            }
            if ($paidAmount === (float)$order->total_price && $response->result->status === 'COMPLETED') {
                $order->status = Order::STATUS_COMPLETED;
            }
            $order->transaction_id = $response->result->purchase_units[0]->payments->captures[0]->id;
            if($order->save()){
                return [
                    'success' => true
                ] ;
            }
        }

        throw new BadRequestHttpException();
    

        $status = Yii::$app->request->post('status');
       

       

        
    }

}  