<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Teacher */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Teacher', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Teacher'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'forename',
        'surname',
        [
                'attribute' => 'gender.id',
                'label' => 'Gender'
            ],
        'birthdate',
        'birthplace:ntext',
        'address:ntext',
        'nationality',
        'email:email',
        'mobile',
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
if($providerGroupCourseDetail->totalCount){
    $gridColumnGroupCourseDetail = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'group.id',
                'label' => 'Group'
            ],
        [
                'attribute' => 'course.id',
                'label' => 'Course'
            ],
                ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerGroupCourseDetail,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Group Course Detail'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnGroupCourseDetail
    ]);
}
?>
    </div>
</div>
