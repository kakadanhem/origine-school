<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model InvoiceSearch */
/* @var $form yii\widgets\ActiveForm */
$enrollment_id = isset($_GET['InvoiceSearch']['enrollment_id']) ? $_GET['InvoiceSearch']['enrollment_id'] : null;
$enrollment = empty($enrollment_id) ? '' : \app\models\Enrollment::findOne($enrollment_id)->title;
?>

<div class="form-invoice-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <div class="row">
        <div class="col-md-4">
    <?= $form->field($model, 'invoiceNo')->textInput(['maxlength' => true, 'placeholder' => 'InvoiceNo']) ?>
        </div>
        <div class="col-md-4">
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
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'dueDate')->widget(\kartik\daterange\DateRangePicker::className(), [
                'presetDropdown' => true,
                'options' => ['format' => ['date','d MMMM Y'], 'label' => 'Enroll Date'],
                'attribute'=>'enrollDateRange',
                'convertFormat'=>true,
                'startAttribute'=>'dueDateStart',
                'endAttribute'=> 'dueDateEnd',
                'pluginOptions'=>[
                    'locale'=>[
                        'cancelLabel' => 'Cancel',
                        'format'=>'Y-m-d',
                        'separator'=>' to '
                    ]
                ],
            ]);
            ?>
        </div>

    </div>
    <div class="row">

        <div class="col-md-2">
            <?= $form->field($model, 'discount')->textInput(['placeholder' => 'Discount']) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'is_amount', ['options' => ['style' => '']])->checkbox([
                'class' => 'toggle-checkbox',
                'label' => 'In Amount<span class="toggle-label" style="margin-top:10px;">In Amount</span>',
            ]);?>
        </div>

    <?php /* echo $form->field($model, 'status_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Appendix::find()->orderBy('id')->asArray()->all(), 'id', 'description'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Appendix')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'dueDate')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('app', 'Choose DueDate'),
                'autoclose' => true
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'term_id')->textInput(['placeholder' => 'Term']) */ ?>

    <?php /* echo $form->field($model, 'semester_id')->textInput(['placeholder' => 'Semester']) */ ?>

    <?php /* echo $form->field($model, 'academicYear_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Academicyear::find()->orderBy('id')->asArray()->all(), 'id', 'description'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Academicyear')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); */ ?>

    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
