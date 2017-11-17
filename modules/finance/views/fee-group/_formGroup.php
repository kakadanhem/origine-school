<div class="form-group" id="add-group">
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
    'formName' => 'Group',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions' => ['hidden'=>true]],
        'description' => ['type' => TabularForm::INPUT_TEXT],
        'term_id' => [
            'label' => 'Term',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Term::find()->orderBy('description')->asArray()->all(), 'id', 'description'),
                'options' => ['placeholder' => 'Choose Term'],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'timetable_id' => [
            'label' => 'Timetable',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Timetable::find()->orderBy('description')->asArray()->all(), 'id', 'description'),
                'options' => ['placeholder' => 'Choose Timetable'],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'grade_id' => [
            'label' => 'Grade',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Grade::find()->orderBy('description')->asArray()->all(), 'id', 'description'),
                'options' => ['placeholder' => 'Choose Grade'],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'branch_id' => [
            'label' => 'Branch',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Branch::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
                'options' => ['placeholder' => 'Choose Branch'],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'maxEnrollment' => ['type' => TabularForm::INPUT_TEXT],
        "lock" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions' => ['hidden'=>true]],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return
                    Html::hiddenInput('Children[' . $key . '][id]', (!empty($model['id'])) ? $model['id'] : "") .
                    Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  'Delete', 'onClick' => 'delRowGroup(' . $key . '); return false;', 'id' => 'group-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Group', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowGroup()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

