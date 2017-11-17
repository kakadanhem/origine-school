<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EnrollmentFee */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="enrollment-fee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'enrollment_id')->widget(\kartik\select2\Select2::classname(), [
        'initValueText' => 'Start Searching', // set the initial display text
        'options' => ['placeholder' => 'Search for an enrollment ...'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 3,
            'language' => [
                'errorLoading' => new \yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
            ],
            'ajax' => [
                'url' =>  Yii::$app->homeUrl . '?r=enrollment-tool/enrollment/enrollment-list',
                'dataType' => 'json',
                'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }')
            ],
            'escapeMarkup' => new \yii\web\JsExpression('function (markup) { return markup; }'),
            'templateResult' => new \yii\web\JsExpression('function(enrollment) { return enrollment.text; }'),
            'templateSelection' => new \yii\web\JsExpression('function (enrollment) { return enrollment.text; }'),
        ],
    ]);
    ?>

    <?= $form->field($model, 'fee_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => $feeData,
        'options' => ['placeholder' => 'Choose Fee'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'is_amount', ['options' => ['style' => '']])->checkbox([
        'class' => 'toggle-checkbox',
        'label' => 'Amount<span class="toggle-label" style="margin-top:10px;">Amount</span>',
    ]);?>

    <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <div class="form-group">
    <?php if(Yii::$app->controller->action->id != 'save-as-new'): ?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?php endif; ?>
    <?php if(Yii::$app->controller->action->id != 'create'): ?>
        <?= Html::submitButton('Save As New', ['class' => 'btn btn-primary', 'value' => '1', 'name' => '_asnew']) ?>
    <?php endif; ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
