<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Commune */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Commune', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="commune-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Commune'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name:ntext',
        [
                'attribute' => 'district.name',
                'label' => 'District'
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
if($providerAddress->totalCount){
    $gridColumnAddress = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'streetAddress',
        [
                'attribute' => 'village.name',
                'label' => 'Village'
            ],
                [
                'attribute' => 'district.name',
                'label' => 'District'
            ],
        [
                'attribute' => 'province.name',
                'label' => 'Province'
            ],
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerAddress,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Address'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnAddress
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerVillage->totalCount){
    $gridColumnVillage = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'name:ntext',
                ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerVillage,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Village'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnVillage
    ]);
}
?>
    </div>
</div>
