<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\InvoiceItem */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Invoice Item'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-item-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Invoice Item').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'invoice.id',
                'label' => Yii::t('app', 'Invoice')
            ],
        [
                'attribute' => 'fee.description',
                'label' => Yii::t('app', 'Fee')
            ],
        'amount',
        'discount',
        [
                'attribute' => 'discountType.description',
                'label' => Yii::t('app', 'DiscountType')
            ],
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
