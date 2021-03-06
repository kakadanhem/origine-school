<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\School */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'School', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="school-view">

    <div class="row">
        <div class="col-sm-8">
            <h2><?= 'School'.' '. Html::encode($this->title) ?></h2>
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
        <div class="col-md-12">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'short_name',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
<?php
if($providerBranch->totalCount){
    $gridColumnBranch = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            'name',
            [
                'attribute' => 'streetAddress.streetAddress',
                'label' => 'StreetAddress'
            ],
            'telephone',
            'email:email',
            'website',
             ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerBranch,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-branch']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="fa fa-cubes"></span> ' . Html::encode('Branch'),
        ],
        'columns' => $gridColumnBranch
    ]);
}
?>
        </div>
    </div>
</div>
