<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label' => 'Product Image',
                'attribute' => 'image',
                'format' => ['html'],
                'value' => fn() => Html::img($model->getImageUrl(), ['style' => 'width: 60px']),
            ],
            'name',
            'description:html',
            'price:currency',
            [
                'attribute' => 'status',
                'format' => ['html'],
                'value' => fn() => Html::tag('span', $model->status ? 'Active' : 'Inactive', [
                    'class' => $model->status ? 'badge badge-success' : 'badge badge-danger'
                ])
            ],
            [
                'attribute' => 'created_at',
                'format' => ['datetime'],
                'contentOptions' => ['style' => 'white-space: nowrap']
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['datetime'],
                'contentOptions' => ['style' => 'white-space: nowrap']
            ],
            'createdBy.username',
            'updatedBy.username',
        ],
    ]) ?>

</div>
