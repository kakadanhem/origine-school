<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\District */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'District', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="district-view">

    <div class="row">
        <div class="col-sm-8">
            <h2><?= 'District'.' '. Html::encode($this->title) ?></h2>
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
            <?= Html::a('Save As New', ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
        'name:ntext',
        [
            'attribute' => 'provinces.name',
            'label' => 'Provinces',
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
                'attribute' => 'commune.name',
                'label' => 'Commune'
            ],
                        [
                'attribute' => 'province.name',
                'label' => 'Province'
            ],
            ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerAddress,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-address']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Address'),
        ],
        'columns' => $gridColumnAddress
    ]);
}
?>

    </div>
    
    <div class="row">
<?php
if($providerCommune->totalCount){
    $gridColumnCommune = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            'name:ntext',
                        ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerCommune,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-commune']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Commune'),
        ],
        'columns' => $gridColumnCommune
    ]);
}
?>

    </div>
    <div class="row">
        <h4>Province<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnProvince = [
        ['attribute' => 'id', 'visible' => false],
        'name:ntext',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->provinces,
        'attributes' => $gridColumnProvince    ]);
    ?>
</div>
