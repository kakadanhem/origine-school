<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\GroupCourseDetail */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Group Course Detail', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-course-detail-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Group Course Detail'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'group.id',
                'label' => 'Group'
            ],
        [
                'attribute' => 'course.id',
                'label' => 'Course'
            ],
        [
                'attribute' => 'teacher.id',
                'label' => 'Teacher'
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
if($providerSchedule->totalCount){
    $gridColumnSchedule = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
                [
                'attribute' => 'session.id',
                'label' => 'Session'
            ],
        [
                'attribute' => 'day.id',
                'label' => 'Day'
            ],
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerSchedule,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Schedule'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnSchedule
    ]);
}
?>
    </div>
</div>
