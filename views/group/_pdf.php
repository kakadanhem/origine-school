<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Group */

$this->title = $model->description;
$this->params['breadcrumbs'][] = ['label' => 'Group', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Group'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'description',
        [
                'attribute' => 'term.description',
                'label' => 'Term'
            ],
        [
                'attribute' => 'timetable.description',
                'label' => 'Timetable'
            ],
        [
                'attribute' => 'grade.description',
                'label' => 'Grade'
            ],
        [
                'attribute' => 'branch.id',
                'label' => 'Branch'
            ],
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerEnrollment->totalCount){
    $gridColumnEnrollment = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'student.id',
                'label' => 'Student'
            ],
                'enrollDate',
        [
                'attribute' => 'enrollType.description',
                'label' => 'EnrollType'
            ],
        'discount',
        [
                'attribute' => 'discountType.description',
                'label' => 'DiscountType'
            ],
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerEnrollment,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Enrollment'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnEnrollment
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerGroupcoursedetail->totalCount){
    $gridColumnGroupcoursedetail = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
                [
                'attribute' => 'course.description',
                'label' => 'Course'
            ],
        [
                'attribute' => 'teacher.id',
                'label' => 'Teacher'
            ],
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerGroupcoursedetail,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Groupcoursedetail'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnGroupcoursedetail
    ]);
}
?>
    </div>
</div>
