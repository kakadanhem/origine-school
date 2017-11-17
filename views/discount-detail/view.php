<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\DiscountDetail */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Discount Detail'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discount-detail-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Discount Detail').' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'discount.id',
            'label' => Yii::t('app', 'Discount'),
        ],
        [
            'attribute' => 'feeCategory.id',
            'label' => Yii::t('app', 'FeeCategory'),
        ],
        'value',
        'isamount',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4>Discount<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnDiscount = [
        ['attribute' => 'id', 'visible' => false],
        'title',
        'description',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->discount,
        'attributes' => $gridColumnDiscount    ]);
    ?>
    <div class="row">
        <h4>Feecategory<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnFeecategory = [
        ['attribute' => 'id', 'visible' => false],
        'description',
        'billPerDay',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->feeCategory,
        'attributes' => $gridColumnFeecategory    ]);
    ?>
</div>
