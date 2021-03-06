<div class="form-group" id="add-enrollment">
<?php
use kartik\grid\GridView;
use kartik\builder\TabularForm;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

$dataProvider = new ArrayDataProvider([
    'allModels' => $row,
    'pagination' => [
        'pageSize' => -1
    ]
]);
echo TabularForm::widget([
    'dataProvider' => $dataProvider,
    'formName' => 'Enrollment',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions' => ['hidden'=>true]],
        'group_id' => [
            'label' => 'Group',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Group::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
                'options' => ['placeholder' => 'Choose Group'],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'enrollDate' => ['type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\datecontrol\DateControl::classname(),
            'options' => [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                'saveFormat' => 'php:Y-m-d',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose EnrollDate',
                        'autoclose' => true
                    ]
                ],
            ]
        ],
        'enrollType_id' => [
            'label' => 'Type',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Appendix::find()->where(['appendixCategory_id' => '2'])->orderBy('id')->asArray()->all(), 'id', 'description'),
                'options' => ['placeholder' => 'Choose Type'],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'discount' => ['type' => TabularForm::INPUT_TEXT],
        'discountType' => [
            'label' => 'Appendix',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Appendix::find()->where(['appendixCategory_id' => '5'])->orderBy('id')->asArray()->all(), 'id', 'description'),
                'options' => ['placeholder' => 'Choose Discount Type'],
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
                    Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  'Delete', 'onClick' => 'delRowEnrollment(' . $key . '); return false;', 'id' => 'enrollment-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Enrollment', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowEnrollment()']) . ' ' .
                Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Group',[
                    //<---- here is where you define the action that handles the ajax request
                    'class'=>'btn btn-success create-group-modal-click',
                    'data-toggle'=>'tooltip',
                    'data-placement'=>'bottom',
                    'title'=>'Create Group'
                ]),
        ]
    ]
]);

Modal::begin([
    'closeButton' => [
        'label' => 'Close',
        'class' => 'btn btn-danger btn-sm pull-right',
    ],
    'header'=>'<h4>Create Guardian</h4>',
    'id'=>'create-group-modal',
    'size'=>'modal-lg'
]);

$groupModel = new \app\models\Group();
echo $this->render('/group/createModal', ['model' => $groupModel]);

Modal::end();

echo  "    </div>\n\n";
?>

