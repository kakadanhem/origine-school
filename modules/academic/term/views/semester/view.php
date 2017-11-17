<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Semester */

$this->title = $model->description;
$this->params['breadcrumbs'][] = ['label' => 'Semester', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="semester-view">
    <?php var_dump($model->firstTerm->startDate) ?>
    <div class="row">
        <div class="col-sm-8">
            <h2><?= 'Semester'.' '. Html::encode($this->title) ?></h2>
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
            'attribute' => 'academicYear.id',
            'label' => 'AcademicYear',
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
        <h4>AcademicYear<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnAcademicYear = [
        ['attribute' => 'id', 'visible' => false],
        'description',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->academicYear,
        'attributes' => $gridColumnAcademicYear    ]);
    ?>
    
    <div class="row">
<?php
if($providerTerm->totalCount){
    $gridColumnTerm = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            'description',
            'startDate',
            'endDate',
                        ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerTerm,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-term']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Term'),
        ],
        'columns' => $gridColumnTerm
    ]);
}
?>

    </div>
</div>
