<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Address */

$this->title = $model->streetAddress;
$this->params['breadcrumbs'][] = ['label' => 'Address', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="address-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Address'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'streetAddress',
        [
                'attribute' => 'village.id',
                'label' => 'Village'
            ],
        [
                'attribute' => 'commune.id',
                'label' => 'Commune'
            ],
        [
                'attribute' => 'district.id',
                'label' => 'District'
            ],
        [
                'attribute' => 'province.id',
                'label' => 'Province'
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
if($providerGuardian->totalCount){
    $gridColumnGuardian = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'forename',
        'surname',
        [
                'attribute' => 'gender.id',
                'label' => 'Gender'
            ],
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
if($providerStaff->totalCount){
    $gridColumnStaff = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'forename',
        'surname',
        [
                'attribute' => 'gender.id',
                'label' => 'Gender'
            ],
        'birthdate',
                        [
                'attribute' => 'nationality0.id',
                'label' => 'Nationality'
            ],
        [
                'attribute' => 'religion0.id',
                'label' => 'Religion'
            ],
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
</div>
