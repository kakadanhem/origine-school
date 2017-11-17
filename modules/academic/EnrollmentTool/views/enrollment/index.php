<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\EnrollmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use kartik\widgets\Select2;
use kartik\daterange\DateRangePicker;
$this->title = \app\modules\academic\EnrollmentTool\EnrollmentTool::t('Enrollment', 'Enrollment' );
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

    <div class="search-form">
    <?=  $this->render('_search', [
        'model' => $searchModel,
        'branch' => $branch,
    ]); ?>
    </div>

    <?php
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn',
        'headerOptions' =>['style'=>'width: 40px'],
        ],
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
            'headerOptions' =>['style'=>'width: 120px'],
                'attribute' => 'grade_id',
                'label' => 'Grade',
                'value' => function($model){
                    if ($model->grade)
                    {return $model->grade->description;}
                    else
                    {return NULL;}
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\Grade::find()->asArray()->all(), 'id', 'description'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Grade', 'id' => 'grid-enrollment-search-grade_id']
            ],
        [
            'headerOptions' =>['style'=>'width: 100px'],
            'attribute' => 'gender_id',
            'label' => 'Gender',
            'value' => function($model){
                if ($model->student)
                {return $model->student->gender->description;}
                else
                {return NULL;}
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\app\models\Appendix::find()->where(['appendixCategory_id'=> '1'])->asArray()->all(), 'id', 'description'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Gender', 'id' => 'grid-enrollment-search-branch_id']
        ],
        [   'attribute' => 'enrollDate',
            'headerOptions' =>['style'=>'width: 140px'],
            'format' => ['date','d MMMM Y'],
            'label' => 'Enroll Date',
        ],
        [
                'attribute' => 'enrollType_id',
            'headerOptions' =>['style'=>'width: 80px'],
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
                'filterInputOptions' => ['placeholder' => 'Type', 'id' => 'grid-enrollment-search-enrollType']
            ],
        [   'attribute' => 'discount_id',
            'headerOptions' =>['style'=>'width: 80px'],
            'label' => 'Discount',
            'value' => function($model){
                if(empty($model->discount)){
                    return 'Not Set';
                }else{ return $model->discount->title;}
            },
            'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\Discount::find()->asArray()->all(), 'id', 'title'),
                'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Type', 'id' => 'grid-enrollment-search-discount']
        ],
        [   'attribute' => 'totalFee',
            'headerOptions' =>['style'=>'width: 80px'],
            'label' => 'Discount',
            'value' => function($model){
                if(empty($model->totalFee)){
                    return 'Not Set';
                }else{ return Yii::$app->formatter->asCurrency($model->totalFee);}
            },
        ],
        [   'label' => 'Pay Term',
            'attribute' => 'payTerm_id',
            'headerOptions' =>['style'=>'width: 80px'],
            'value' => 'payTerm.title',
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\app\models\Appendix::find()->where(['appendixCategory_id' => '7'])->asArray()->all(), 'id', 'title'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Status', 'id' => 'grid-enrollment-search-payterm']

        ],
        [   'label' => 'Status',
            'attribute' => 'paymentStatus_id',
            'headerOptions' =>['style'=>'width: 80px'],
            'value' => 'paymentStatus.title',
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\app\models\Appendix::find()->where(['appendixCategory_id' => '6'])->asArray()->all(), 'id', 'title'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Status', 'id' => 'grid-enrollment-search-payment-status']

        ],
        ['attribute' => 'lock', 'visible' => false],
        [
            'class' => 'yii\grid\ActionColumn',
            'headerOptions' =>['style'=>'width: 90px'],
            'template' => '{view} {update} {delete}',
            'buttons' => [
                'update' => function ($url, $model){
                    $status = $model->getPaymentExist();
                    return $status ? '' : Html::a('<i class="paperfont pixel15 left5 paper-update"></i>', $url, ['title' => 'Update']);
                },
                'view' => function ($url){
                    return Html::a('<i class="paperfont pixel15 left5 paper-view"></i>', $url, ['title' => 'View']);
                },
                'delete' => function ($url, $model){
                    $status = $model->getPaymentExist();
                    return $status ? '' : Html::a('<i class="paperfont pixel15 left5 paper-remove"></i>', $url, [
                            'title' => 'Delete',
                        'data' => [
                        'confirm' => "Are you sure you want to delete profile?",
                        'method' => 'post',
                        ],
                    ]);
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
            'heading' => '<span class="fa fa-id-card"></span>  ' . Html::encode($this->title),
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
