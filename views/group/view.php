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
        <div class="col-sm-8">
            <h2><?= 'Group'.' '. Html::encode($this->title) ?></h2>
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
        'description',
        [
            'attribute' => 'term.description',
            'label' => 'Term',
        ],
        [
            'attribute' => 'maxEnrollment',
            'label' => 'Max Enrollment',
        ],
        [
            'attribute' => 'timetable.description',
            'label' => 'Timetable',
        ],
        [
            'attribute' => 'grade.description',
            'label' => 'Grade',
        ],
        [
            'attribute' => 'branch.name',
            'label' => 'Branch',
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-enrollment']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="fa fa-user-o"></span> ' . Html::encode('Student\'s Enrollments'),
        ],
        'columns' => $gridColumnEnrollment
    ]);
}
?>

    </div>
<!--    <div class="row">
        <h4>Branch<?/*= ' '. Html::encode($this->title) */?></h4>
    </div>
    <?php /*
    $gridColumnBranch = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'streetAddress_id',
        'telephone',
        'email',
        'website',
        'image_src',
        'image_web',
        'school_id',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->branch,
        'attributes' => $gridColumnBranch    ]);
    */?>
    <div class="row">
        <h4>Grade<?/*= ' '. Html::encode($this->title) */?></h4>
    </div>
    <?php /*
    $gridColumnGrade = [
        ['attribute' => 'id', 'visible' => false],
        'description',
        'program_id',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->grade,
        'attributes' => $gridColumnGrade    ]);
    */?>
    <div class="row">
        <h4>Term<?/*= ' '. Html::encode($this->title) */?></h4>
    </div>
    --><?php /*
    $gridColumnTerm = [
        ['attribute' => 'id', 'visible' => false],
        'description',
        'startDate',
        'endDate',
        'semester_id',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->term,
        'attributes' => $gridColumnTerm    ]);
    */?>
    <div class="row">
        <h4><i  class="fa fa-calendar pull-left"></i>Timetable<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnTimetable = [
        ['attribute' => 'id', 'visible' => false],
        'description',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->timetable,
        'attributes' => $gridColumnTimetable    ]);
    ?>
</div>
