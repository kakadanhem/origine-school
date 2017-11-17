<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\InvoiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = Yii::t('app', 'Invoice');
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);

?>
<div class="invoice-index">

    <p>
        <?= Html::a(Yii::t('app', '<i class="paperfont left pixel20 paper-add"></i>Create Invoice'), ['create'], ['class' => 'btn paper-button-peter-river']) ?>
        <?= Html::a(Yii::t('app', '<i class="paperfont left pixel20 paper-add"></i>Extra Invoice'), ['create-extra'], ['class' => 'btn paper-button-asbestos']) ?>
        <?= Html::a(Yii::t('app', '<i class="paperfont left pixel20 paper-binoculars"></i>Advance Search'), '#', ['class' => 'btn search-button paper-button-emerald']) ?>
    </p>
    <div class="search-form" style="display:none">
        <?=  $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <?php
    $student = empty($model->enrollment) ? '' : \app\models\Student::findOne($model->enrollment->student_id)->surnameEn;
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'class' => 'kartik\grid\ExpandRowColumn',
            'width' => '50px',
            'value' => function ($model, $key, $index, $column) {
                return GridView::ROW_COLLAPSED;
            },
            'detail' => function ($model, $key, $index, $column) {
                return Yii::$app->controller->renderPartial('_expand', ['model' => $model]);
            },
            'headerOptions' => ['class' => 'kartik-sheet-style'],
            'expandOneOnly' => true
            ],
        ['attribute' => 'id', 'visible' => false],
        [   'attribute' =>'invoiceNo',
            'headerOptions' =>['style'=>'width: 130px'],
            ],
        [   'attribute' => 'dueDate',
            'headerOptions' =>['style'=>'width: 160px'],
            'format' => ['date','d MMMM Y'],
            'label' => 'Due Date',
            'filterType' => GridView::FILTER_DATE_RANGE,
            'filterWidgetOptions' => [
                'model'=>$searchModel,
                'attribute'=>'dueDateRange',
                'convertFormat'=>true,
                'startAttribute'=>'dueDateStart',
                'endAttribute'=> 'dueDateEnd',
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
            'attribute' => 'student_id',
            'label' => Yii::t('app', 'Student'),
            'value' => function($model){
                if ($model->enrollment)
                {return  $model->enrollment->student->fullname;}
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
            'attribute' => 'grade_id',
            'label' => Yii::t('app', 'Grade'),
            'value' => function($model){
                if ($model->enrollment)
                {return $model->enrollment->grade->description;}
                else
                {return NULL;}
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => $grades,
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'Grades', 'id' => 'grid-invoice-search-grade_id']
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
        [   'attribute' => 'totalAmount',
            'headerOptions' =>['style'=>'width: 80px'],
            'format' => ['currency'],
        ],
        [
                'attribute' => 'status_id',
                'label' => Yii::t('app', 'Status'),
                'value' => function($model){
                    if ($model->status)
                    {return $model->status->title;}
                    else
                    {return NULL;}
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $paymentStatus,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Status', 'id' => 'grid-invoice-search-status_id']
            ],
        ['attribute' => 'lock', 'visible' => false],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update}',
            'headerOptions' =>['style'=>'width: 90px'],
            'buttons' => [
                'update' => function ($url, $model){
                    return Html::a('<i class="paperfont pixel15 left5 paper-update"></i>', $url, ['title' => 'Update']);
                },
                'view' => function ($url){
                    return Html::a('<i class="paperfont pixel15 left5 paper-view"></i>', $url, ['title' => 'View']);
                },
                'delete' => function ($url){
                    return Html::a('<i class="paperfont pixel15 left5 paper-remove"></i>', $url, ['title' => 'Delete']);
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
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-invoice']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
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
