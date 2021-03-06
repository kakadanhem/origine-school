<div class="form-group" id="add-invoiceitem">
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
    'formName' => 'Invoiceitem',
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
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Fee::find()->orderBy('description')->asArray()->all(), 'id', 'description'),
                'options' => ['placeholder' => Yii::t('app', 'Choose Fee')],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'amount' => ['type' => TabularForm::INPUT_TEXT],
        'discount' => ['type' => TabularForm::INPUT_TEXT],
        'is_amount' => [
            'label' => 'Appendix',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Appendix::find()->orderBy('description')->asArray()->all(), 'id', 'description'),
                'options' => ['placeholder' => Yii::t('app', 'Choose Appendix')],
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
                    Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  Yii::t('app', 'Delete'), 'onClick' => 'delRowInvoiceitem(' . $key . '); return false;', 'id' => 'invoiceitem-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', 'Add Invoiceitem'), ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowInvoiceitem()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

