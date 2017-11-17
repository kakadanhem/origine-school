<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Guardian */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'Studentguardian', 
        'relID' => 'studentguardian', 
        'value' => \yii\helpers\Json::encode($model->studentguardians),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
$commune = empty($model->commune) ? 'Select commune' : $model->commune->name;
$village = empty($model->village) ? 'Select village' : $model->village->name;
$district = empty($model->district) ? 'Select village' : $model->district->name;
?>

<div class="guardian-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>
    <div class="row">
        <div class="col-md-5"><?= $form->field($model, 'forename')->textInput(['maxlength' => true, 'placeholder' => 'Forename']) ?></div>
        <div class="col-md-5"><?= $form->field($model, 'surname')->textInput(['maxlength' => true, 'placeholder' => 'Surname']) ?></div>
        <div class="col-md-2">
            <?= $form->field($model, 'gender_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Appendix::find()->where(["appendixCategory_id" => "1"])->orderBy('id')->asArray()->all(), 'id', 'description'),
                'options' => ['placeholder' => 'Choose Gender'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2"><?= $form->field($model, 'streetAddress')->textInput(['maxlength' => true, 'placeholder' => 'StreetAddress']) ?></div>
        <div class="col-md-2">
            <?php $provinceDesc = empty($model->province_id) ? '' : $model->province->name ?>
            <?= $form->field($model, 'province_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Province::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
                'options' => ['placeholder' => '-- Province --', 'id' => 'address-province_id'],
                'pluginOptions' => [
                    'allowClear' => true,

                ],
                'pluginEvents' => [
                    'change' => 'function(){ getDistrict($("#address-province_id option:selected").val());}',
                ],

            ]); ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'district_id')->widget(\kartik\widgets\Select2::classname(), [
                'options' => ['placeholder' => '-- District --', 'id' => 'address-district_id'],
                'initValueText' => $district,
                'pluginOptions' => [
                    'allowClear' => true,

                ],
                'pluginEvents' => [
                    'change' => 'function(){ getCommune($("#address-district_id option:selected").val());}',
                ],
            ]); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'commune_id')->widget(\kartik\widgets\Select2::classname(), [
                'initValueText' => $commune,
                'options' => ['placeholder' => '-- Commune --', 'id' => 'address-commune_id'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
                'pluginEvents' => [
                    'change' => 'function(){ getVillage($("#address-commune_id option:selected").val());}',
                ],
            ]); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'village_id')->widget(\kartik\widgets\Select2::classname(), [
                'initValueText' => $village,
                'options' => ['placeholder' => '-- Village --', 'id' => 'address-village_id'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3"><?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email']) ?></div>
        <div class="col-md-3"><?= $form->field($model, 'mobile')->textInput(['maxlength' => true, 'placeholder' => 'Mobile']) ?></div>
        <div class="col-md-3"><?= $form->field($model, 'workplace')->textInput(['placeholder' => 'Workplace']) ?></div>
        <div class="col-md-3"><?= $form->field($model, 'position')->textInput(['maxlength' => true, 'placeholder' => 'Position']) ?></div>
    </div>

    <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?php
/*    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Student')),
            'content' => $this->render('_formStudentguardian', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->studentguardians),
            ]),
        ],
    ];
    echo kartik\tabs\TabsX::widget([
        'items' => $forms,
        'position' => kartik\tabs\TabsX::POS_ABOVE,
        'encodeLabels' => false,
        'bordered' => true,
        'containerOptions' =>[
            'class' => 'origine-white-tab',
        ],
        'pluginOptions' => [
            'sideways' => true,
            'enableCache' => false,
        ],
    ]);*/
    ?>
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
