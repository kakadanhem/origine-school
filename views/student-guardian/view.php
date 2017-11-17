<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\StudentGuardian */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Student Guardian'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-guardian-view">

    <div class="row">
        <div class="col-sm-8">
            <h2><?= Yii::t('app', 'Student Guardian').' '. Html::encode($this->title) ?></h2>
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
        [
            'attribute' => 'student.id',
            'label' => Yii::t('app', 'Student'),
        ],
        [
            'attribute' => 'guardian.id',
            'label' => Yii::t('app', 'Guardian'),
        ],
        [
            'attribute' => 'relationship.id',
            'label' => Yii::t('app', 'Relationship'),
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
        <h4>Guardian<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnGuardian = [
        ['attribute' => 'id', 'visible' => false],
        'forename',
        'surname',
        'gender_id',
        'streetAddress',
        'province_id',
        'district_id',
        'commune_id',
        'village_id',
        'email',
        'mobile',
        'workplace',
        'position',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->guardian,
        'attributes' => $gridColumnGuardian    ]);
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
        'model' => $model->relationship,
        'attributes' => $gridColumnAppendix    ]);
    ?>
    <div class="row">
        <h4>Student<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnStudent = [
        ['attribute' => 'id', 'visible' => false],
        'studentCode',
        'forenameEn',
        'surnameEn',
        'forenameKh',
        'surnameKh',
        'nickname',
        'gender_id',
        'birthdate',
        'nationality_id',
        'religion_id',
        'passportNo',
        'passportExpire',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->student,
        'attributes' => $gridColumnStudent    ]);
    ?>
</div>
