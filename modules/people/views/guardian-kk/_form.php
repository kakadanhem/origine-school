<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Guardian */
/* @var $form yii\widgets\ActiveForm */

$search = "$('.address-button').click(function(){
	$('.address-form').toggle(10000);
	return false;
});";
$this->registerJs($search);

?>

<div class="guardian-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($guardian); ?>

    <?= $form->field($guardian, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($guardian, 'forename')->textInput(['maxlength' => true, 'placeholder' => 'Forename']) ?>

    <?= $form->field($guardian, 'surname')->textInput(['maxlength' => true, 'placeholder' => 'Surname']) ?>

    <?= $form->field($guardian, 'gender_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Appendix::find()->where(["appendixCategory_id" => "1"])->orderBy('id')->asArray()->all(), 'id', 'description'),
        'options' => ['placeholder' => 'Choose Gender'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?php
    $url = Yii::$app->homeUrl . '?r=address/address-list';
    //$url = \yii\helpers\Url::to(['address-list']);
    $cityDesc = empty($guardian->streetAddress) ? '' : \app\models\Address::findOne($model->streetAddress)->streetAddress;

    echo $form->field($guardian, 'streetAddress')->widget(\kartik\select2\Select2::classname(), [
    'initValueText' => $cityDesc, // set the initial display text
    'options' => ['placeholder' => 'Search for an address ...'],
    'pluginOptions' => [
        'allowClear' => true,
        'minimumInputLength' => 3,
        'language' => [
        'errorLoading' => new \yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
        ],
        'ajax' => [
        'url' => $url,
        'dataType' => 'json',
        'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }')
        ],
        'escapeMarkup' => new \yii\web\JsExpression('function (markup) { return markup; }'),
        'templateResult' => new \yii\web\JsExpression('function(city) { return city.text; }'),
        'templateSelection' => new \yii\web\JsExpression('function (city) { return city.text; }'),
        ],
    ]); ?>


    <?= $form->field($guardian, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email']) ?>

    <?= $form->field($guardian, 'mobile')->textInput(['maxlength' => true, 'placeholder' => 'Mobile']) ?>

    <?= $form->field($guardian, 'workplace')->textInput(['placeholder' => 'Workplace']) ?>

    <?= $form->field($guardian, 'position')->textInput(['maxlength' => true, 'placeholder' => 'Position']) ?>

    <?= $form->field($guardian, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('Children'),
            'content' => $this->render('_formStudentguardian', [
                'row' => \yii\helpers\ArrayHelper::toArray($guardian->studentguardians),
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
        <?= Html::submitButton($guardian->isNewRecord ? 'Create' : 'Update', ['class' => $guardian->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?php endif; ?>
    <?php if(Yii::$app->controller->action->id != 'create'): ?>
        <?= Html::submitButton('Save As New', ['class' => 'btn btn-primary', 'value' => '1', 'name' => '_asnew']) ?>
    <?php endif; ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
