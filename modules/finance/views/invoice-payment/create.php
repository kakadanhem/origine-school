<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\InvoicePayment */

$this->title = Yii::t('app', 'Collect Payment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Invoice Payment'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-payment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'invoice' => $invoice,
        'paymentMethod' => $paymentMethod,
    ]) ?>

</div>
