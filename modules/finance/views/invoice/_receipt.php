<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Invoice */

$this->title = $ReceiptNo;
?>
<div class="invoice-view">
    <div class="row invoice-title">
        <div class="col-sm-12">
            <div>
                <?php echo '<img class="invoice-logo" src="'.Yii::$app->getUrlManager()->getBaseUrl(). '/uploads/branch/'.$model->enrollment->branch->image_web.'">' ?>
                <div class="invoice-title"><?= Yii::t('app', 'RECEIPT').' | '. Html::encode($this->title) ?></div>
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
                    ['class' => 'yii\grid\SerialColumn', 'headerOptions' => ['style' => 'width:40px']],
                    ['attribute' => 'id', 'visible' => false],
                    [
                        'attribute' => 'fee.description',
                        'label' => Yii::t('app', 'Fee'),
                        'footer' => 'Total<hr/>After Discount'
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
                        'footer' =>  Yii::$app->formatter->asCurrency($model->totalDiscount) . '<hr/>',
                    ],
                    [   'attribute' => 'amount',
                        'headerOptions' =>['style'=>'width: 150px'],
                        'value' => function($providerInvoiceitem){
                            return Yii::$app->formatter->asCurrency($providerInvoiceitem->amount);
                        },
                        'footer' =>  Yii::$app->formatter->asCurrency($model->totalAmount) . '<hr/>'
                            .Yii::$app->formatter->asCurrency($model->totalAmountAfterDiscount)
                    ],

                    ['attribute' => 'lock', 'visible' => false],
                ];
                echo Gridview::widget([
                    'dataProvider' => $providerInvoiceitem,
                    'panel' => [
                        'type' => GridView::TYPE_PRIMARY,
                        'heading' => Html::encode(Yii::t('app', 'Items to Pay')),
                    ],
                    'panelHeadingTemplate' => '<h4>{heading}</h4>',
                    'toggleData' => false,
                    'columns' => $gridColumnInvoiceitem,
                    'showFooter'=>TRUE,
                ]);
            }
            ?>

            <?php
            if($providerReceipt->totalCount){
                $gridColumnIReceipt = [
                    ['class' => 'yii\grid\SerialColumn', 'headerOptions' => ['style' => 'width:40px']],
                    ['attribute' => 'id', 'visible' => false],
                    [   'attribute' => 'created_at',
                        'label' => 'Date',
                        'footer' =>  '<b>Total Payments</b>'
                    ],
                    [   'attribute' => 'amount',
                        'headerOptions' =>['style'=>'width: 150px'],
                        'value' => function($providerInvoiceitem){
                            return Yii::$app->formatter->asCurrency($providerInvoiceitem->amount);
                        },
                        'footer' =>  '<b>' . Yii::$app->formatter->asCurrency($model->paidAmount) . '</b>'
                    ],
                    ['attribute' => 'lock', 'visible' => false],
                ];
                echo Gridview::widget([
                    'dataProvider' => $providerReceipt,
                    'panel' => [
                        'type' => GridView::TYPE_PRIMARY,
                        'heading' => Html::encode(Yii::t('app', 'Payment Received')),
                    ],
                    'panelHeadingTemplate' => '<h4>{heading}</h4>',
                    'toggleData' => false,
                    'columns' => $gridColumnIReceipt,
                    'showFooter'=>TRUE,
                ]);
            }
            ?>
        </div>
    </div>
    
    <div class="row">

    </div>
</div>
