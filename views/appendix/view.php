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
        <div class="col-sm-8">
            <h2><?= 'Appendix'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa fa-file-pdf-o"></i> ' . 'PDF',
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => 'Will open the generated PDF file in a new window'
                ]
            )?>
            <?= Html::a('Save As New', ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>            
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
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
            'label' => 'AppendixCategory',
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
        <h4>Appendixcategory<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnAppendixcategory = [
        ['attribute' => 'id', 'visible' => false],
        'description:ntext',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->appendixCategory,
        'attributes' => $gridColumnAppendixcategory    ]);
    ?>
    
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-enrollment']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Enrollment'),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-enrollmentfee']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Enrollmentfee'),
        ],
        'columns' => $gridColumnEnrollmentfee
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-guardian']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Guardian'),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-schedule']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Schedule'),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-staff']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Staff'),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-student']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Student'),
        ],
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-teacher']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Teacher'),
        ],
        'columns' => $gridColumnTeacher
    ]);
}
?>

    </div>
</div>
