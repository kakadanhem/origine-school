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
        <div class="col-sm-8">
            <h2><?= 'Group Course Detail'.' '. Html::encode($this->title) ?></h2>
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
        [
            'attribute' => 'group.id',
            'label' => 'Group',
        ],
        [
            'attribute' => 'course.id',
            'label' => 'Course',
        ],
        [
            'attribute' => 'teacher.id',
            'label' => 'Teacher',
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
        <h4>Course<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnCourse = [
        ['attribute' => 'id', 'visible' => false],
        'description',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->course,
        'attributes' => $gridColumnCourse    ]);
    ?>
    <div class="row">
        <h4>Group<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnGroup = [
        ['attribute' => 'id', 'visible' => false],
        'description',
        'term_id',
        'timetable_id',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->group,
        'attributes' => $gridColumnGroup    ]);
    ?>
    <div class="row">
        <h4>Teacher<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnTeacher = [
        ['attribute' => 'id', 'visible' => false],
        'forename',
        'surname',
        'gender_id',
        'birthdate',
        'birthplace',
        'address',
        'nationality',
        'email',
        'mobile',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->teacher,
        'attributes' => $gridColumnTeacher    ]);
    ?>
    
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
</div>
