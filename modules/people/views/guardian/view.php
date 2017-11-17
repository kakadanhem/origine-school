<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Guardian */

$this->title = $model->fullname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Guardian'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guardian-view">

    <div class="row">
        <div class="col-sm-5">
            <h2><?= Yii::t('app', 'Guardian').' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-7" style="margin-top: 15px">
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
            <?= Html::a(Yii::t('app', 'Create New'), ['create'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Create Relation'), ['//people/relationship/create'], ['class' => 'btn btn-primary']) ?>
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
        <div class="col-md-12">
<?php
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'gender.description',
            'label' => Yii::t('app', 'Gender'),
        ],
        [   'label' => 'Address',
            'value' => function($model) {
                return $model->streetAddress . ', <b>Phum:</b> ' . $model->village->name . ', <b>Khum:</b> ' . $model->commune->name .
                    ',  <b>Srok:</b> ' .  $model->district->name . ',  <b>Khaet:</b> ' . $model->province->name;
                },
            'format' => 'html',
            ],
        'email:email',
        'mobile',
        'workplace',
        'position',
        [
            'label' => Yii::t('app','Children'),
            'format' => 'html',
            'value' => function($model){
                    foreach($model->studentguardians as $studentguardian){
                        return Html::a( $studentguardian->student->fullname,'index.php?r=people/student/view&id=' . $studentguardian->student_id) . '<br/>';
                    }
                }
            ],
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
        </div>
    </div>
</div>
