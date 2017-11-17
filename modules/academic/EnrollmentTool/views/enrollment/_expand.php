<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;
$items = [
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Enrollment'),
        'content' => $this->render('_detail', [
            'model' => $model,
            'fullname' => $model->student->surnameEn . ' ' . $model->student->forenameEn,
        ]),
    ],
    [
        'label' => '<i class="fa fa-credit-card-alt"></i> '. Html::encode('Fee'),
        'content' => $this->render('_dataEnrollmentFee', [
            'model' => $model,
            'row' => $model->enrollmentFees,
        ]),
    ],
    [
        'label' => '<i class="fa fa-file-text"></i> '. Html::encode('Invoice'),
        'content' => $this->render('_dataInvoice', [
            'model' => $model,
            'row' => $model->invoices,
        ]),
    ],
    ];
echo TabsX::widget([
    'items' => $items,
    'position' => TabsX::POS_ABOVE,
    'encodeLabels' => false,
    'class' => 'tes',
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
