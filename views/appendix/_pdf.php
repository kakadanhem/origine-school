<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Appendix */

$this->title = $model->description;
$this->params['breadcrumbs'][] = ['label' => 'Appendix', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appendix-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Appendix'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'title',
        'description:ntext',
        [
                'attribute' => 'appendixCategory.description',
                'label' => 'AppendixCategory'
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
        [
                'attribute' => 'group.description',
                'label' => 'Group'
            ],
        'enrollDate',
                'discount',
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
if($providerEnrollmentfee->totalCount){
    $gridColumnEnrollmentfee = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'enrollment.id',
                'label' => 'Enrollment'
            ],
        [
                'attribute' => 'fee.description',
                'label' => 'Fee'
            ],
        'amount',
        'discount',
                ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerEnrollmentfee,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Enrollmentfee'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnEnrollmentfee
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerEnrollmentpayment->totalCount){
    $gridColumnEnrollmentpayment = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'enrollment.id',
                'label' => 'Enrollment'
            ],
        'amount',
                ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerEnrollmentpayment,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Enrollmentpayment'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnEnrollmentpayment
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerGuardian->totalCount){
    $gridColumnGuardian = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'forename',
        'surname',
                'address:ntext',
        'email:email',
        'mobile',
        'workplace',
        'position',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerGuardian,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Guardian'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnGuardian
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerSchedule->totalCount){
    $gridColumnSchedule = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'groupCourseDetail.id',
                'label' => 'GroupCourseDetail'
            ],
        [
                'attribute' => 'session.description',
                'label' => 'Session'
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
    
    <div class="row">
<?php
if($providerStaff->totalCount){
    $gridColumnStaff = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'forename',
        'surname',
                'birthdate',
        'birthplace:ntext',
        'address:ntext',
        'nationality',
        'religion',
        'email:email',
        'mobile',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerStaff,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Staff'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnStaff
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerStudent->totalCount){
    $gridColumnStudent = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'forenameEn',
        'surnameEn',
        'forenameKh',
        'surnameKh',
        'nickname',
                'birthdate',
                        'passportNo',
        'passportExpire',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerStudent,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Student'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnStudent
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerTeacher->totalCount){
    $gridColumnTeacher = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'forename',
        'surname',
                'birthdate',
        'birthplace:ntext',
        'address:ntext',
        'nationality',
        'email:email',
        'mobile',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerTeacher,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Teacher'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnTeacher
    ]);
}
?>
    </div>
</div>
