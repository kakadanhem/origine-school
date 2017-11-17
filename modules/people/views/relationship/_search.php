<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StudentGuardianSearch */
/* @var $form yii\widgets\ActiveForm */
$student =  empty($model->student) ? : $model->student->fullname;
$guardian =  empty($model->guardian) ? : $model->guardian->fullname;
?>

<div class="form-student-guardian-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>
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
                'url' =>  Yii::$app->homeUrl . '?r=people/student/student-list',
                'dataType' => 'json',
                'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }')
            ],
            'escapeMarkup' => new \yii\web\JsExpression('function (markup) { return markup; }'),
            'templateResult' => new \yii\web\JsExpression('function(city) { return city.text; }'),
            'templateSelection' => new \yii\web\JsExpression('function (city) { return city.text; }'),
        ],
    ]);
    ?>
    </div><div class="col-md-4">

    <?= $form->field($model, 'guardian_id')->widget(\kartik\select2\Select2::classname(), [
        'initValueText' => $guardian, // set the initial display text
        'options' => ['placeholder' => 'Search for a guardian ...'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 3,
            'language' => [
                'errorLoading' => new \yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
            ],
            'ajax' => [
                'url' =>  Yii::$app->homeUrl . '?r=people/guardian/guardian-list',
                'dataType' => 'json',
                'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }')
            ],
            'escapeMarkup' => new \yii\web\JsExpression('function (markup) { return markup; }'),
            'templateResult' => new \yii\web\JsExpression('function(guardian) { return guardian.text; }'),
            'templateSelection' => new \yii\web\JsExpression('function (guardian) { return guardian.text; }'),
        ],
    ]);
    ?>
    </div>
    <div class="col-md-4">

    <?= $form->field($model, 'relationship_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Appendix::find()->where(['appendixCategory_id' => '8'])->orderBy('id')->asArray()->all(), 'id', 'description'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Relationship')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
    </div>
    </div>
    <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <div class="form-group">
        <?= Html::a(Yii::t('app', 'Create Relation'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
