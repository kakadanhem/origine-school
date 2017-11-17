<div class="form-group" id="add-discountgroupdetail">
<?php
use kartik\grid\GridView;
use kartik\builder\TabularForm;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\widgets\Pjax;

$dataProvider = new ArrayDataProvider([
    'allModels' => $row,
    'pagination' => [
        'pageSize' => -1
    ]
]);

echo TabularForm::widget([
    'dataProvider' => $dataProvider,
    'formName' => 'Discountgroupdetail',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions' => ['hidden'=>true]],
        'enrollment_id' => [
            'label' => 'Enrollment',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => function($model, $key, $index, $widget) {
                $initValueText = empty($model['enrollment_id']) ? 'Select Enrollment' : \app\models\Enrollment::findOne($model['enrollment_id'])->title;
                return [
                    'initValueText' => $initValueText,
                    'options' => ['placeholder' => Yii::t('app', 'Choose Enrollment')],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'minimumInputLength' => 3,
                        'language' => [
                            'errorLoading' => new \yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
                        ],
                        'ajax' => [
                            'url' => Yii::$app->homeUrl . '?r=enrollment-tool/enrollment/enrollment-list',
                            'dataType' => 'json',
                            'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }')
                        ],
                        'escapeMarkup' => new \yii\web\JsExpression('function (markup) { return markup; }'),
                        'templateResult' => new \yii\web\JsExpression('function(enrollment) { return enrollment.text; }'),
                        'templateSelection' => new \yii\web\JsExpression('function (enrollment) { return enrollment.text; }'),
                    ],
                ];
            }
        ],
        "lock" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions' => ['hidden'=>true]],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return
                    Html::hiddenInput('Children[' . $key . '][id]', (!empty($model['id'])) ? $model['id'] : "") .
                    Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  Yii::t('app', 'Delete'), 'onClick' => 'delRowDiscountgroupdetail(' . $key . '); return false;', 'id' => 'discountgroupdetail-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Discountgroupdetail'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowDiscountgroupdetail()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

