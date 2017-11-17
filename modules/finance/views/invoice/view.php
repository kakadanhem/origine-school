<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Invoice */

$this->title = Yii::t('app', 'Invoice').' '. $model->invoiceNo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Invoice'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-view">
    <div class="row">
        <div class="col-sm-6">
            <h2><?=  Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-6" style="margin-top: 15px">
            <?=
             Html::a('<i class="fa fa-print"></i> ' . Yii::t('app', 'Print Invoice'),
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => Yii::t('app', 'Will open the generated PDF file in a new window')
                ]
            )?>
            <?=
            count($model->receipts) == 0 ? '':
            Html::a('<i class="fa fa-print"></i> ' . Yii::t('app', 'Print Receipt'),
                ['receipt', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => Yii::t('app', 'Will open the generated PDF file in a new window')
                ]
            );
            ?>
            <?= Html::a(Yii::t('app', 'Collect Payment'), ['invoice-payment/collect', 'invoiceId' => $model->id], ['class' => 'btn btn-info']) ?>
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
        <div class="col-md-12">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'invoiceNo',
        [
            'attribute' => 'enrollment.id',
            'format' => 'html',
            'value' => function($model) {
                return $model->enrollment->enrollCode . ' ' . Html::a($model->enrollment->student->fullname,
                        'index.php?r=people/student/view&id=' . $model->enrollment->student_id);
            },
            'label' => Yii::t('app', 'Enrollment'),
        ],
        [   'attribute' => 'discount',
            'headerOptions' =>['style'=>'width: 80px'],
            'value' => function($model) {
                if ($model->is_amount == true) {
                    return Yii::$app->formatter->asCurrency($model->discount);
                } else {
                    return Yii::$app->formatter->asPercent($model->discount / 100, 2);
                }
            },
        ],
        [
            'attribute' => 'status.description',
            'label' => Yii::t('app', 'Status'),
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
    </div>
    
    <div class="row">
        <div class="col-md-12">
<?php
if($providerInvoiceitem->totalCount){
    $gridColumnInvoiceitem = [
        [   'class' => 'yii\grid\SerialColumn',
            'headerOptions' => ['style' => 'width:50px']
        ],
            ['attribute' => 'id', 'visible' => false],
                        [
                'attribute' => 'fee.description',
                'label' => Yii::t('app', 'Fee')
            ],
        [ 'attribute' => 'amount',
            'value' => function($providerInvoiceitem){
                return Yii::$app->formatter->asCurrency($providerInvoiceitem->amount);
            },
            'footer' =>  Yii::$app->formatter->asCurrency($model->totalAmount) . '<br/>'
                .Yii::$app->formatter->asCurrency($model->totalAmountAfterDiscount) . ' After items discounted' . '<br/>'
        ],
        [   'attribute' => 'discount',
            'value' => function($model) {
                if ($model->is_amount == true) {
                    return Yii::$app->formatter->asCurrency($model->discount);
                } else {
                    return Yii::$app->formatter->asPercent($model->discount / 100, 2);
                }
            },
            'footer' =>  Yii::$app->formatter->asCurrency($model->totalDiscount),
        ],
            ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerInvoiceitem,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-invoiceitem']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="fa fa-money"></span> ' . Html::encode(Yii::t('app', 'Invoice Items')),
        ],
        'columns' => $gridColumnInvoiceitem,
        'showFooter'=>TRUE,
    ]);
}
?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
<?php
if($providerInvoicepayment->totalCount){
    $gridColumnInvoicepayment = [
        [   'class' => 'yii\grid\SerialColumn',
            'headerOptions' => ['style' => 'width:50px']
        ],
            ['attribute' => 'id', 'visible' => false],
            [   'attribute' => 'amount',
                'value' => function($providerInvoicepayment){
                    return Yii::$app->formatter->asCurrency($providerInvoicepayment->amount);
                },
                'footer' =>  Yii::$app->formatter->asCurrency($model->paidAmount),
            ],
            ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerInvoicepayment,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-invoicepayment']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="fa fa-credit-card"></span> ' . Html::encode(Yii::t('app', 'Payment Received')),
        ],
        'columns' => $gridColumnInvoicepayment
    ]);
}
?>
        </div>
    </div>
</div>
