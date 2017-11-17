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
        <div class="col-sm-8">
            <h2><?= 'Guardian'.' '. Html::encode($this->title) ?></h2>
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
        'forename',
        'surname',
        [
            'attribute' => 'gender.id',
            'label' => 'Gender',
        ],
        [
            'attribute' => 'streetAddress0.id',
            'label' => 'StreetAddress',
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
        'model' => $model->gender,
        'attributes' => $gridColumnAppendix    ]);
    ?>
    <div class="row">
        <h4>Address<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnAddress = [
        ['attribute' => 'id', 'visible' => false],
        'village_id',
        'commune_id',
        'district_id',
        'province_id',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->streetAddress0,
        'attributes' => $gridColumnAddress    ]);
    ?>
    
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-studentguardian']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Studentguardian'),
        ],
        'columns' => $gridColumnStudentguardian
    ]);
}
?>

    </div>
</div>
