<?php
$url = \yii\helpers\Url::to(['province-list']);
$urlDistrict = \yii\helpers\Url::to(['district-list']);

use app\models\Province;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\Address */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'Guardian', 
        'relID' => 'guardian', 
        'value' => \yii\helpers\Json::encode($model->guardians),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'Staff', 
        'relID' => 'staff', 
        'value' => \yii\helpers\Json::encode($model->staff),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>
<div class="address-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'streetAddress')->textInput(['maxlength' => true, 'placeholder' => 'StreetAddress']) ?>

    <?php $provinceDesc = empty($model->province_id) ? '' :'Phnom Penh' ?>

    <?= $form->field($model, 'province_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Province::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => '-- Province --'],
        'pluginOptions' => [
            'allowClear' => true,

        ],
        'pluginEvents' => [
                'change' => 'function(){ getDistrict($("#address-province_id option:selected").val());}',
        ],

    ]); ?>


    <?= $form->field($model, 'district_id')->widget(\kartik\widgets\Select2::classname(), [
        'options' => ['placeholder' => '-- District --'],
        'pluginOptions' => [
            'allowClear' => true,

        ],
        'pluginEvents' => [
            'change' => 'function(){ getCommune($("#address-district_id option:selected").val());}',
        ],
    ]); ?>

    <?= $form->field($model, 'commune_id')->widget(\kartik\widgets\Select2::classname(), [
        'options' => ['placeholder' => '-- Commune --'],
        'pluginOptions' => [
            'allowClear' => true
        ],
        'pluginEvents' => [
            'change' => 'function(){ getVillage($("#address-commune_id option:selected").val());}',
        ],
    ]); ?>

    <?= $form->field($model, 'village_id')->widget(\kartik\widgets\Select2::classname(), [
         'options' => ['placeholder' => '-- Village --'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

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
