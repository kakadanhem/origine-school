<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\EnrollmentFeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = \app\modules\academic\EnrollmentTool\EnrollmentTool::t('Enrollment','Create Fee');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enrollment-fee-index">

    <p>
        <?= Html::a('Create Enrollment Fee', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php 
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn','headerOptions' =>['style'=>'width: 50px'],],
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'grade_name',
            'label' => 'Grade',
            'headerOptions' =>['style'=>'width: 110px'],
            'value' => function($model){
                if ($model->enrollment)
                {return $model->enrollment->grade->description;}
                else
                {return NULL;}
            },
        ],
        [
            'attribute' => 'student_name',
            'label' => 'Student',
            'headerOptions' =>['style'=>'width: 250px'],
            'value' => function($model){
                if ($model->enrollment)
                {return $model->enrollment->student->fullname;}
                else
                {return NULL;}
            },
        ],
        [
            'attribute' => 'fee_id',
            'label' => 'Fee',
            'headerOptions' =>['style'=>'width: 250px'],
            'value' => function($model){
                    if ($model->fee)
                    {return $model->fee->description;}
                    else
                    {return NULL;}
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $feeData,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Fee', 'id' => 'grid-enrollment-fee-search-fee_id']
            ],
        [   'attribute' =>'amount',
            'headerOptions' =>['style'=>'width: 120px'],
            'value' => function($model){
                if ($model->amount)
                {return Yii::$app->formatter->asCurrency($model->amount);}
                else
                {return NULL;}
            }],
        [   'attribute' => 'discount',
            'headerOptions' =>['style'=>'width: 80px'],
            'value' => function($model) {
                if ($model->is_amount == '1') {
                    return Yii::$app->formatter->asCurrency($model->discount);
                } else {
                    return Yii::$app->formatter->asPercent($model->discount / 100, 0);
                }
            }],
        ['attribute' => 'lock', 'visible' => false],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{save-as-new}{update} {delete}',
            'headerOptions' =>['style'=>'width: 80px'],
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
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-enrollment-fee']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="fa fa-credit-card-alt"></span>  ' . Html::encode($this->title),
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
