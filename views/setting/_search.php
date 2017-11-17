<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SettingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-setting-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true, 'placeholder' => 'Code']) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true, 'placeholder' => 'Description']) ?>

    <?= $form->field($model, 'parameter1')->textInput(['maxlength' => true, 'placeholder' => 'Parameter1']) ?>

    <?= $form->field($model, 'parameter2')->textInput(['maxlength' => true, 'placeholder' => 'Parameter2']) ?>

    <?php /* echo $form->field($model, 'parameter3')->textInput(['maxlength' => true, 'placeholder' => 'Parameter3']) */ ?>

    <?php /* echo $form->field($model, 'parameter4')->textInput(['maxlength' => true, 'placeholder' => 'Parameter4']) */ ?>

    <?php /* echo $form->field($model, 'category')->textInput(['maxlength' => true, 'placeholder' => 'Category']) */ ?>

    <?php /* echo $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); */ ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
