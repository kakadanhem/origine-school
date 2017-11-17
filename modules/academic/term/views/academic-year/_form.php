<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AcademicYear */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'Semester', 
        'relID' => 'semester', 
        'value' => \yii\helpers\Json::encode($model->semesters),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
$checkboxTemplate = '<div class="material-switch  pull-right">{input}{error}{hint}</div>';
?>

<div class="academic-year-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>
<div class="row">
    <div class="col-md-10">
    <?= $form->field($model, 'description')->textInput(['maxlength' => true, 'placeholder' => 'Description']) ?>
    </div>

    <div class="col-md-2">
        <?= $form->field($model, 'active', ['options' => ['style' => '']])->checkbox([
                'class' => 'toggle-checkbox',
                'label' => 'Active<span class="toggle-label" style="margin-top:10px;">Active</span>',
        ]);?>
    </div>
</div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'startDate')->widget(\kartik\datecontrol\DateControl::classname(), [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose StartDate',
                        'autoclose' => true
                    ]
                ],
            ]); ?>

        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'endDate')->widget(\kartik\datecontrol\DateControl::classname(), [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose EndDate',
                        'autoclose' => true
                    ]
                ],
            ]); ?>
        </div>
    </div>
    <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>
    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('Semester'),
            'content' => $this->render('_formSemester', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->semesters),
            ]),
        ],
    ];
    echo kartik\tabs\TabsX::widget([
        'items' => $forms,
        'position' => kartik\tabs\TabsX::POS_ABOVE,
        'encodeLabels' => false,
        'pluginOptions' => [
            'bordered' => true,
            'sideways' => true,
            'enableCache' => false,
        ],
    ]);
    ?>

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
