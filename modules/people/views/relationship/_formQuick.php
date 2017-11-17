<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StudentGuardian */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-guardian-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>
    <?= $form->field($model, 'guardian_id', ['template' => '{input}'])->textInput(['value' => $guardian->id,'style' => 'display:none']); ?>
    <?= $form->field($model, 'student_id', ['template' => '{input}'])->textInput(['value' => $student->id,'style' => 'display:none']); ?>

    <?= Html::a($guardian->fullname,'index.php?r=people/guardian/view&id=' . $guardian->id) ?>

    <b>With</b>

    <?= Html::a($student->fullname,'index.php?r=people/student/view&id=' . $student->id) ?>
    <br/>
    <br/>

    <?= $form->field($model, 'relationship_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Appendix::find()->where(['appendixCategory_id' => '8'])->orderBy('id')->asArray()->all(), 'id', 'description'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Relationship')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <div class="form-group">
    <?php if(Yii::$app->controller->action->id != 'save-as-new'): ?>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?php endif; ?>
    <?php if(Yii::$app->controller->action->id != 'create'): ?>
        <?= Html::submitButton(Yii::t('app', 'Save As New'), ['class' => 'btn btn-info', 'value' => '1', 'name' => '_asnew']) ?>
    <?php endif; ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
