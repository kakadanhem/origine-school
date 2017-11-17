<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Student */

$this->title = $model->allFullname;
$this->params['breadcrumbs'][] = ['label' => 'Student', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="student-view">

    <div class="row">
        <div class="col-sm-6">
            <h2><?= 'Student'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-6" style="margin-top: 15px">
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
            <?= Html::a('Create New', ['create'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Create Parents', ['guardian/create-specific', 'sid' => $model->id ], ['class' => 'btn btn-primary']) ?>
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
        [   'attribute' =>'allFullname',
            'label' => 'Fullname'
            ],
        [
            'attribute' => 'gender.description',
            'label' => 'Gender',
        ],
        'birthdate',
        [
            'attribute' => 'nationality.nationality',
            'label' => 'Nationality',
        ],
        [
            'attribute' => 'nationality.name',
            'label' => 'Country',
        ],
        [
            'attribute' => 'religion.description',
            'label' => 'Religion',
        ],
        [
            'attribute' => 'discount.description',
            'label' => 'Discount',
        ],
        'passportNo',
        'passportExpire',
        [
            'label' => Yii::t('app','Guardian'),
            'format' => 'html',
            'value' => function($model){
                if(!empty($model->studentguardians)){
                    foreach($model->studentguardians as $studentguardian){
                        return Html::a( $studentguardian->guardian->fullname,'index.php?r=people/guardian/view&id=' . $studentguardian->guardian_id)
                                . ' Telephone : ' . $studentguardian->guardian->mobile . '<br/>';
                    }
                }else{}
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
    
    <div class="row">
        <div class="col-md-12">
<?php
if($providerEnrollment->totalCount){
    $gridColumnEnrollment = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        [
                'attribute' => 'grade.description',
                'label' => 'Grade'
            ],
            'enrollDate',
            [
                'attribute' => 'enrollType.description',
                'label' => 'Enroll Type'
            ],
            [   'attribute' => 'discount.description',
            ],
            ['attribute' => 'lock', 'visible' => false],
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' =>['style'=>'width: 90px'],
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($model,$key) {
                        return Html::a('<span class="fa fa-eye"></span>',
                            'index.php?r=enrollment-tool/enrollment/view&id=' . $key->id, ['title' => 'View']);
                    },
                ],
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerEnrollment,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-enrollment']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Enrollment'),
        ],
        'columns' => $gridColumnEnrollment
    ]);
}
?>

        </div>
    </div>
</div>
