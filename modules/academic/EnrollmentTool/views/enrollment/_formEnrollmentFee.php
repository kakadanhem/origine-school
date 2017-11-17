<div class="form-group" id="add-enrollment-fee">
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

$query = \app\models\Fee::find()->select(['fee.id as id', 'fee.description as description', 'feeCategory.description as category'])
    ->leftJoin('feeCategory', 'fee.feeCategory_id = feeCategory.id')
    ->asArray()
    ->all();

echo TabularForm::widget([
    'dataProvider' => $dataProvider,
    'formName' => 'EnrollmentFee',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions' => ['hidden'=>true]],
        'fee_id' => [
            'label' => 'Fee',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'pluginEvents' => [
                "change" => "alert('select');",
            ],
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map($query, 'id', 'description', 'category'),
                'options' => ['placeholder' => 'Choose Fee'],
                'pluginOptions' => [
                    'allowClear' => true,

                ],
            ],
            'columnOptions' => ['width' => '200px'],
        ],
        'amount' => [
                'type' => TabularForm::INPUT_TEXT,
                'options' => [
                        'readonly' => true,
                        ]
        ],
        'discount' => ['type' => TabularForm::INPUT_TEXT],
        'is_amount' => [
            'label' => 'Discount Type',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Appendix::find()->where(['appendixCategory_id'=>'5'])->orderBy('id')->asArray()->all(), 'id', 'description'),
                'options' => ['placeholder' => 'Choose Appendix'],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        "lock" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions' => ['hidden'=>true]],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return
                    Html::hiddenInput('Children[' . $key . '][id]', (!empty($model['id'])) ? $model['id'] : "") .
                    Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  'Delete', 'onClick' => 'delRowEnrollmentFee(' . $key . '); return false;', 'id' => 'enrollment-fee-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Fee', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowEnrollmentFee()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

