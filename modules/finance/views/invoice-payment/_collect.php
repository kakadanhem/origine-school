<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InvoicePayment */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="invoice-payment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'invoice_id', ['template' => '{input}'])->textInput(['value' => $invoice->id, 'style' => 'display:none']); ?>

    <div style="margin-bottom: 10px; " class="cl-pomegranate">Amount to fullpay : <?php echo Yii::$app->formatter->asCurrency($invoice->finalAmountAfterDiscount - $invoice->paidAmount);  ?></div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'amount')->textInput(['placeholder' => 'Amount']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'paymentMethod_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => $paymentMethod,
                'options' => ['placeholder' => 'Choose Method'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
    </div>

    <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <div class="form-group">
    <?php if(Yii::$app->controller->action->id != 'save-as-new'): ?>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?php endif; ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
