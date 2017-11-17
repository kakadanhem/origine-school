<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Student */

$this->title = $model->forenameEn;
$this->params['breadcrumbs'][] = ['label' => 'Student', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Student'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'forenameEn',
        'surnameEn',
        'forenameKh',
        'surnameKh',
        'nickname',
        [
                'attribute' => 'gender.id',
                'label' => 'Gender'
            ],
        'birthdate',
        [
                'attribute' => 'nationality.id',
                'label' => 'Nationality'
            ],
        [
                'attribute' => 'religion.id',
                'label' => 'Religion'
            ],
        'passportNo',
        'passportExpire',
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
                'attribute' => 'group.id',
                'label' => 'Group'
            ],
        'enrollDate',
        [
                'attribute' => 'enrollType.id',
                'label' => 'EnrollType'
            ],
        'discount',
        [
                'attribute' => 'discountType.id',
                'label' => 'DiscountType'
            ],
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
if($providerStudentguardian->totalCount){
    $gridColumnStudentguardian = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
                [
                'attribute' => 'guardian.id',
                'label' => 'Guardian'
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
