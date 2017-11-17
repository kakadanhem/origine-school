<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Guardian */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Guardian'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guardian-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Guardian').' '. Html::encode($this->title) ?></h2>
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
                'label' => Yii::t('app', 'Gender')
            ],
        'streetAddress',
        [
                'attribute' => 'province.id',
                'label' => Yii::t('app', 'Province')
            ],
        [
                'attribute' => 'district.id',
                'label' => Yii::t('app', 'District')
            ],
        [
                'attribute' => 'commune.id',
                'label' => Yii::t('app', 'Commune')
            ],
        [
                'attribute' => 'village.id',
                'label' => Yii::t('app', 'Village')
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
                'label' => Yii::t('app', 'Student')
            ],
                'relation',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerStudentguardian,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Studentguardian')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnStudentguardian
    ]);
}
?>
    </div>
</div>
