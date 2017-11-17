<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Invoice */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Invoice'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Invoice').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'invoiceNo',
        [
                'attribute' => 'enrollment.id',
                'label' => Yii::t('app', 'Enrollment')
            ],
        'discount',
        [
                'attribute' => 'discountType.description',
                'label' => Yii::t('app', 'DiscountType')
            ],
        [
                'attribute' => 'status.description',
                'label' => Yii::t('app', 'Status')
            ],
        'dueDate',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerInvoiceitem->totalCount){
    $gridColumnInvoiceitem = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
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
    echo Gridview::widget([
        'dataProvider' => $providerInvoiceitem,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Invoiceitem')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnInvoiceitem
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerInvoicepayment->totalCount){
    $gridColumnInvoicepayment = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
                'amount',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerInvoicepayment,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Invoicepayment')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnInvoicepayment
    ]);
}
?>
    </div>
</div>
