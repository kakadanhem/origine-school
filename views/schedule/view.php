<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Schedule */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Schedule', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schedule-view">

    <div class="row">
        <div class="col-sm-8">
            <h2><?= 'Schedule'.' '. Html::encode($this->title) ?></h2>
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
            'attribute' => 'groupCourseDetail.id',
            'label' => 'GroupCourseDetail',
        ],
        [
            'attribute' => 'session.description',
            'label' => 'Session',
        ],
        [
            'attribute' => 'day.description',
            'label' => 'Day',
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
        <h4>Appendix<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnAppendix = [
        ['attribute' => 'id', 'visible' => false],
        'title',
        'description',
        'appendixCategory_id',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->day,
        'attributes' => $gridColumnAppendix    ]);
    ?>
    <div class="row">
        <h4>GroupCourseDetail<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnGroupCourseDetail = [
        ['attribute' => 'id', 'visible' => false],
        'group_id',
        'course_id',
        'teacher_id',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->groupCourseDetail,
        'attributes' => $gridColumnGroupCourseDetail    ]);
    ?>
    <div class="row">
        <h4>Session<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnSession = [
        ['attribute' => 'id', 'visible' => false],
        'description',
        'startTime',
        'endTime',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->session,
        'attributes' => $gridColumnSession    ]);
    ?>
</div>
