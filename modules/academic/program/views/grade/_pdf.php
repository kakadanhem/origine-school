<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Grade */

$this->title = $model->description;
$this->params['breadcrumbs'][] = ['label' => 'Grade', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grade-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Grade'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'description',
        [
                'attribute' => 'program.description',
                'label' => 'Program'
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
if($providerGroup->totalCount){
    $gridColumnGroup = [
        ['class' => 'yii\grid\SerialColumn'],
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
                'attribute' => 'branch.id',
                'label' => 'Branch'
            ],
        'maxEnrollment',
        [
                'attribute' => 'feeGroup.description',
                'label' => 'FeeGroup'
            ],
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerGroup,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Group'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnGroup
    ]);
}
?>
    </div>
</div>
