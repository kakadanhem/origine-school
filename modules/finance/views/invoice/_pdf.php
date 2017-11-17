<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Invoice */

$this->title = $model->invoiceNo;
?>
<div class="invoice-view">
    <div class="row invoice-title">
        <div class="col-sm-12">
            <div>
                <?php echo '<img class="invoice-logo" src="'.Yii::$app->getUrlManager()->getBaseUrl(). '/uploads/branch/'.$model->enrollment->branch->image_web.'">' ?>
                <div class="invoice-title"><?= Yii::t('app', 'Invoice').' '. Html::encode($this->title) ?></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'enrollment.title',
                'label' => Yii::t('app', 'Enrollment')
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
                'attribute' => 'status.title',
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
    </div>
    
    <div class="row">
        <div class="col-sm-12">
<?php
if($providerInvoiceitem->totalCount){
    $gridColumnInvoiceitem = [
        ['class' => 'yii\grid\SerialColumn', 'headerOptions' => ['style' => 'width:50px']],
        ['attribute' => 'id', 'visible' => false],
                [
                'attribute' => 'fee.description',
                'label' => Yii::t('app', 'Fee')
            ],
        [   'attribute' => 'amount',
            'headerOptions' =>['style'=>'width: 200px'],
            'value' => function($providerInvoiceitem){
                return Yii::$app->formatter->asCurrency($providerInvoiceitem->amount);
            },
            'footer' =>  Yii::$app->formatter->asCurrency($model->totalAmount) . '<br/>'
                .Yii::$app->formatter->asCurrency($model->totalAmountAfterDiscount) . ' After discounted' . '<br/>'
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
            'footer' =>  Yii::$app->formatter->asCurrency($model->totalDiscount),
        ],
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerInvoiceitem,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Invoice Items')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>',
        'toggleData' => false,
        'columns' => $gridColumnInvoiceitem,
        'showFooter'=>TRUE,
    ]);
}
?>
        </div>
    </div>
    
    <div class="row">

    </div>
</div>
