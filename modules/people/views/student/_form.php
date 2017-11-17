<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerJsFile('@web/script/modalling.js',['depends' => [\yii\web\JqueryAsset::className()]]);

/* @var $this yii\web\View */
/* @var $model app\models\Student */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'Enrollment', 
        'relID' => 'enrollment', 
        'value' => \yii\helpers\Json::encode($model->enrollments),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'Studentguardian', 
        'relID' => 'studentguardian', 
        'value' => \yii\helpers\Json::encode($model->studentguardians),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="student-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'forenameEn')->textInput(['maxlength' => true, 'placeholder' => 'Forename']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'surnameEn')->textInput(['maxlength' => true, 'placeholder' => 'Surename']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'forenameKh')->textInput(['maxlength' => true, 'placeholder' => 'ឈ្មោះ']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'surnameKh')->textInput(['maxlength' => true, 'placeholder' => 'ត្រគោល']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'nickname')->textInput(['maxlength' => true, 'placeholder' => 'Nickname']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'gender_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Appendix::find()->where(['appendixCategory_id' => '1'])->orderBy('id')->asArray()->all(), 'id', 'description'),
                'options' => ['placeholder' => 'Choose Gender'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'birthdate')->widget(\kartik\datecontrol\DateControl::classname(), [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose Birthdate',
                        'autoclose' => true
                    ]
                ],
            ]); ?>
        </div>
        <div class="col-md-3">

        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'nationality_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Country::find()->orderBy('id')->asArray()->all(), 'id', 'nationality'),
                'options' => ['placeholder' => 'Choose Nationality'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'religion_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Appendix::find()->where(['appendixCategory_id' => '4'])->orderBy('id')->asArray()->all(), 'id', 'description'),
                'options' => ['placeholder' => 'Choose Religion'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'passportNo')->textInput(['maxlength' => true, 'placeholder' => 'PassportNo']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'passportExpire')->widget(\kartik\datecontrol\DateControl::classname(), [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose PassportExpire',
                        'autoclose' => true
                    ]
                ],
            ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'discount_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Discount::find()->orderBy('id')->asArray()->all(), 'id', 'title'),
                'options' => ['placeholder' => 'Choose Discount'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
    </div>

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
