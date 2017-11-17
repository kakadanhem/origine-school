<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Guardian */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Guardian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guardian-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Guardian'.' '. Html::encode($this->title) ?></h2>
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
        [
                'attribute' => 'streetAddress0.id',
                'label' => 'StreetAddress'
            ],
        'email:email',
        'mobile',
        'workplace',
        'position',
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
if($providerStudentguardian->totalCount){
    $gridColumnStudentguardian = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'student.forenameEn',
                'label' => 'Student'
            ],
                'relation',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerStudentguardian,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Studentguardian'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnStudentguardian
    ]);
}
?>
    </div>
</div>
