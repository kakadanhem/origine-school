<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;
$items = [
    [
        'label' => '<i class="fa fa-file-text"></i> '. Html::encode(Yii::t('app', 'Invoice')),
        'content' => $this->render('_detail', [
            'model' => $model,
        ]),
    ],
                    [
        'label' => '<i class="fa fa-file-text"></i> '. Html::encode(Yii::t('app', 'Items')),
        'content' => $this->render('_dataInvoiceitem', [
            'model' => $model,
            'row' => $model->invoiceitems,
        ]),
    ],
            [
        'label' => '<i class="fa fa-credit-card"></i> '. Html::encode(Yii::t('app', 'Payments')),
        'content' => $this->render('_dataInvoicepayment', [
            'model' => $model,
            'row' => $model->invoicepayments,
        ]),
    ],
    ];
echo TabsX::widget([
    'items' => $items,
    'position' => TabsX::POS_ABOVE,
    'encodeLabels' => false,
    'bordered' => true,
    'containerOptions' =>[
        'class' => 'origine-white-tab',
    ],
    'pluginOptions' => [
        'sideways' => true,
        'enableCache' => false
    ],
]);
?>
