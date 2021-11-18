<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <i class="fa-chevron-up"></i>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
            'id' => 'ordersTable',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
                'class' => \yii\bootstrap4\LinkPager::class
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'contentOptions' => ['style' => 'width: 80px']
            ],
            [
                    'attribute' => 'fullname',
                    'content' => function ($model) {
                        return $model->firstname . " " . $model->lastname;
                    }

            ],
            'total_price',
            //'email:email',
            //'transaction_id',
            //'paypal_order_id',
            [
                    'attribute' => 'status',
                    'content' => function($model){
                        if($model->status === \common\models\Order::STATUS_COMPLETED){
                            return \yii\bootstrap4\Html::tag('span', 'completed', ['class' => 'badge badge-success']);
                        } elseif ($model->status === \common\models\Order::STATUS_INACTIVE){
                            return \yii\bootstrap4\Html::tag('span', 'unpaid', ['class' => 'badge badge-secondary']);
                        } else {
                            return \yii\bootstrap4\Html::tag('span', 'failed', ['class' => 'badge badge-danger']);
                        }
                    }
            ],
            'created_at:datetime',
            [
              'class' => 'common\grid\ActionColumn',
                'template' => '{view}{delete}'
            ],
            //'created_by',
            //'deleted_at',
        ],
    ]); ?>


</div>
