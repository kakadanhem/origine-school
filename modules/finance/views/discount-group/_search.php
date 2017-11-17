<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DiscountGroupSearch */
/* @var $form yii\widgets\ActiveForm */

$enrollment_id = isset($_GET['DiscountGroupSearch']['enrollment_id']) ? $_GET['DiscountGroupSearch']['enrollment_id'] : null;
$enrollment = empty($enrollment_id) ? '' : \app\models\Enrollment::findOne($enrollment_id)->title;
?>

<div class="form-discount-group-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'enrollment_id')->widget(\kartik\select2\Select2::classname(), [
        'initValueText' => $enrollment, // set the initial display text
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

    <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
