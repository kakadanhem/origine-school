<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Enrollment */
/* @var $form yii\widgets\ActiveForm */
$student = empty($model->student_id) ? '' : \app\models\Student::findOne($model->student_id)->fullname;
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'Enrollmentfee',
        'relID' => 'enrollmentfee',
        'value' => \yii\helpers\Json::encode($model->enrollmentFees),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'Invoice',
        'relID' => 'invoice',
        'value' => \yii\helpers\Json::encode($model->invoices),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="enrollment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>
    <?= $form->field($model, 'enrollCode', ['template' => '{input}'])->textInput([
        'value' => $enrollCode,
        'readonly' => true,
    ]); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'student_id')->widget(\kartik\select2\Select2::classname(), [
                'initValueText' => $student, // set the initial display text
                'options' => ['placeholder' => 'Search for a student ...'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'minimumInputLength' => 3,
                    'language' => [
                        'errorLoading' => new \yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
                    ],
                    'ajax' => [
                        'url' =>  Yii::$app->homeUrl . '?r=student/student-list',
                        'dataType' => 'json',
                        'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }')
                    ],
                    'escapeMarkup' => new \yii\web\JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new \yii\web\JsExpression('function(city) { return city.text; }'),
                    'templateSelection' => new \yii\web\JsExpression('function (city) { return city.text; }'),
                ],
            ]);
            ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'grade_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Grade::find()->orderBy('id')->asArray()->all(), 'id', 'description'),
                'options' => ['placeholder' => 'Choose Grade'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'branch_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Branch::find()->orderBy('id')->asArray()->all(), 'id', 'shortName'),
                'options' => ['placeholder' => 'Choose Branch'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'payTerm_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Appendix::find()->where(['appendixCategory_id' => '7'])->asArray()->all(), 'id', 'title'),
                'options' => ['placeholder' => 'Choose payment term'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'scheduleType_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Appendix::find()->where(['appendixCategory_id' => '9'])->asArray()->all(), 'id', 'title'),
                'options' => ['placeholder' => 'Choose schedule type'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>

        <div class="col-md-2">
            <?= $form->field($model, 'enrollType_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Appendix::find()->where(['appendixCategory_id' =>'2'])->orderBy('id')->asArray()->all(), 'id', 'description'),
                'options' => ['placeholder' => 'Choose Enrollment Type'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>


        <div class="col-md-2">
            <?= $form->field($model, 'discount_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Discount::find()->asArray()->all(), 'id', 'description'),
                'options' => ['placeholder' => 'Choose Discount Type'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'enrollDate')->widget(\kartik\datecontrol\DateControl::classname(), [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose EnrollDate',
                        'autoclose' => true
                    ]
                ],
            ]); ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'vanService_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Appendix::find()->where(['appendixCategory_id' =>'10'])->orderBy('id')->asArray()->all(), 'id', 'title'),
                'options' => ['placeholder' => 'Choose Van Service'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'lunch', ['options' => ['class' => 'inline-checkbox']])->widget(\kartik\checkbox\CheckboxX::className(),[
                'pluginOptions'=>['threeState'=>false]     ,
            ]);?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'snack', ['options' => ['class' => 'inline-checkbox']])->widget(\kartik\checkbox\CheckboxX::className(),[
                'pluginOptions'=>['threeState'=>false]     ,
            ]);?>
        </div>
    </div>
<?= $form->field($model, 'note')->textarea(['placeholder' => 'Please input notice here']) ?>
<?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Enrollmentfee')),
            'content' => $this->render('_formEnrollmentfee', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->enrollmentFees),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Invoice')),
            'content' => $this->render('_formInvoice', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->invoices),
            ]),
        ],
    ];

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