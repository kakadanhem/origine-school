<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;

/* @var $this yii\web\View */
/* @var $model app\models\EnrollmentSearch */
/* @var $form yii\widgets\ActiveForm */
$student = empty($model->student_id) ? '' : \app\models\Student::findOne($model->student_id)->forenameEn;
$date = empty($model->enrollDateRange) ? '' : \app\models\Enrollment::findOne($model->id)->enrollDate;
?>

<div class="form-enrollment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>
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

        <div class="col-md-3">

            <?= $form->field($model, 'searchprgoram_id')->widget(\kartik\select2\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Program::find()->asArray()->all(),'id','description'),
                'options' => [

                    'placeholder' => 'select program ...',
                    'id' => 'searchprogram_id',],
                'pluginOptions' => [
                    'allowClear' => true,
                    'label' => 'Program',

                ],

            ]);?>
        </div>

<!--        <div class="col-md-2">

            /*= $form->field($model, 'grade_id')->widget(DepDrop::classname(), [
                'type' => 2,
                'options' => ['id' => 'searchgrade_id'],
                'pluginOptions'=>[
                    'allowClear' => true,
                    'depends'=>['searchprogram_id'],
                    'placeholder'=>'please select program...',
                    'url'=> Yii::$app->homeUrl . '?r=program/grade',
                ]
            ]);*/

        </div>-->

        <div class="col-md-3">
            <?= $form->field($model, 'branch_id')->widget(\kartik\select2\Select2::classname(), [
                'data' => $branch,
                'options' => [
                    'placeholder' => 'select branch ...',
                    'id' => 'searchbranch_id',],
                'pluginOptions' => [
                    'allowClear' => true,
                    'label' => 'Branch',

                ],

            ]);?>
        </div>

        </div>

    <div class="row">

        <div class="col-md-3">

            <?= $form->field($model, 'grade_id')->widget(\kartik\select2\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Grade::find()->asArray()->all(),'id','description'),
                'options' => [
                    'placeholder' => 'select grade ...',
                    'id' => 'searchgrade_id',],
                'pluginOptions' => [
                    'allowClear' => true,
                    'label' => 'Grade',

                ],

            ]);?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'enrollDate')->widget(\kartik\daterange\DateRangePicker::className(), [
                'presetDropdown' => true,
                'options' => ['format' => ['date','d MMMM Y'], 'label' => 'Enroll Date'],
                'attribute'=>'enrollDateRange',
                'convertFormat'=>true,
                'startAttribute'=>'enrollDateStart',
                'endAttribute'=> 'enrollDateEnd',
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

    </div>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn paper-button-peter-river']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn paper-button-asbestos']) ?>
        <?= Html::a('Create Enrollment', ['create'], ['class' => 'btn paper-button-emerald']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<hr/>