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
        <div class="col-sm-8">
            <h2><?= Yii::t('app', 'Guardian').' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa fa-file-pdf-o"></i> ' . Yii::t('app', 'PDF'), 
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => Yii::t('app', 'Will open the generated PDF file in a new window')
                ]
            )?>
            <?= Html::a(Yii::t('app', 'Save As New'), ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>            
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
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
            'label' => Yii::t('app', 'Gender'),
        ],
        'streetAddress',
        [
            'attribute' => 'province.id',
            'label' => Yii::t('app', 'Province'),
        ],
        [
            'attribute' => 'district.id',
            'label' => Yii::t('app', 'District'),
        ],
        [
            'attribute' => 'commune.id',
            'label' => Yii::t('app', 'Commune'),
        ],
        [
            'attribute' => 'village.id',
            'label' => Yii::t('app', 'Village'),
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
        <h4>Commune<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnCommune = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        [
            'attribute' => 'district.id',
            'label' => Yii::t('app', 'District'),
        ],
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->commune,
        'attributes' => $gridColumnCommune    ]);
    ?>
    <div class="row">
        <h4>District<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnDistrict = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'provinces_id',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->district,
        'attributes' => $gridColumnDistrict    ]);
    ?>
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
        <h4>Province<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnProvince = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->province,
        'attributes' => $gridColumnProvince    ]);
    ?>
    <div class="row">
        <h4>Village<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnVillage = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        [
            'attribute' => 'commune.id',
            'label' => Yii::t('app', 'Commune'),
        ],
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->village,
        'attributes' => $gridColumnVillage    ]);
    ?>
    
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-studentguardian']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Studentguardian')),
        ],
        'columns' => $gridColumnStudentguardian
    ]);
}
?>

    </div>
</div>
