<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\EnrollmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use kartik\widgets\Select2;
use kartik\daterange\DateRangePicker;

$this->title = 'Enrollment';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
$student = empty($model->student_id) ? '' : \app\models\Student::findOne($model->student_id)->forenameEn;
?>
<?php
//$url = \yii\helpers\Url::to(['address-list']);
?>

<div class="enrollment-index">

    <?php  // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Enrollment', ['create'], ['class' => 'btn btn-success']) ?></p>

    <?php 
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'class' => 'kartik\grid\ExpandRowColumn',
            'width' => '50px',
            'value' => function ($model, $key, $index, $column) {
                return GridView::ROW_COLLAPSED;
            },
            'detail' => function ($model, $key, $index, $column) {
                return Yii::$app->controller->renderPartial('_expand', [
                        'model' => $model,
                ]);
            },
            'headerOptions' => ['class' => 'kartik-sheet-style'],
            'expandOneOnly' => true
        ],
        ['attribute' => 'id', 'visible' => false],
        [
                'label' => 'Student',
                'attribute' => 'student_id',
                'value' => function($model){
                    if ($model->student)
                    {return $model->student->surnameEn . ' ' . $model->student->forenameEn;}
                    else
                    {return NULL;}
                },
                'headerOptions' =>['style'=>'width: 200px'],
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'initValueText' => $student, // set the initial display text
                    'options' => ['placeholder' => 'Search for a student'],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'minimumInputLength' => 3,
                        'language' => [
                            'errorLoading' => new \yii\web\JsExpression("function () { return 'Waiting ...'; }"),
                        ],
                        'ajax' => [
                            'url' =>  Yii::$app->homeUrl . '?r=student/student-list',
                            'dataType' => 'json',
                            'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }')
                        ],
                        'escapeMarkup' => new \yii\web\JsExpression('function (markup) { return markup; }'),
                        'templateResult' => new \yii\web\JsExpression('function(student) { return student.text; }'),
                        'templateSelection' => new \yii\web\JsExpression('function (student) { return student.text; }'),
                    ],
                ]
            ],
        [
                'attribute' => 'group_id',
                'label' => 'Group',
                'value' => function($model){
                    if ($model->group)
                    {return $model->group->description;}
                    else
                    {return NULL;}
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\Group::find()->asArray()->all(), 'id', 'id'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Group', 'id' => 'grid-enrollment-search-group_id']
            ],
        [   'attribute' => 'enrollDate',
            'headerOptions' =>['style'=>'width: 220px'],
            'format' => ['date','d MMMM Y'],
            'label' => 'Enroll Date',
            'filterType' => GridView::FILTER_DATE_RANGE,
            'filterWidgetOptions' => [
                    'model'=>$searchModel,
                    'attribute'=>'enrollDateRange',
                    'convertFormat'=>true,
                    'startAttribute'=>'enrollDateStart',
                    'endAttribute'=> 'enrollDateEnd',
                    'pluginOptions'=>[
                        'locale'=>[
                            'cancelLabel' => 'Cancel',
                            'format'=>'Y-m-d',
                            'separator'=>' to '
                        ]
                    ],
                 ],
        ],
        [
                'attribute' => 'enrollType_id',
                'label' => 'Enroll Type',
                'value' => function($model){
                    if ($model->enrollType)
                    {return $model->enrollType->description;}
                    else
                    {return NULL;}
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\Appendix::find()->where(['appendixCategory_id' => '2'])->asArray()->all(), 'id', 'description'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Enroll Type', 'id' => 'grid-enrollment-search-enrollType']
            ],
        [   'attribute' => 'discount',
            'headerOptions' =>['style'=>'width: 80px'],
            'value' => function($model) {
                if ($model->is_amount == true) {
                    return Yii::$app->formatter->asCurrency($model->discount);
                } else {
                    return Yii::$app->formatter->asPercent($model->discount / 100, 2);
                }
            },
        ],
        ['attribute' => 'lock', 'visible' => false],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{save-as-new} {view} {update} {delete}',
            'buttons' => [
                'save-as-new' => function ($url) {
                    return Html::a('<span class="glyphicon glyphicon-copy"></span>', $url, ['title' => 'Save As New']);
                },
            ],
        ],
    ]; 
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-enrollment']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        // your toolbar can include the additional full export menu
        'toolbar' => [
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Full',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">Export All Data</li>',
                    ],
                ],
            ]) ,
        ],
    ]); ?>

</div>
