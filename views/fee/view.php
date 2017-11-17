<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Fee */

$this->title = $model->description;
$this->params['breadcrumbs'][] = ['label' => 'Fee', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fee-view">

    <div class="row">
        <div class="col-sm-8">
            <h2><?= 'Fee'.' '. Html::encode($this->title) ?></h2>
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
        'description',
        'amount',
        [
            'attribute' => 'feeCategory.description',
            'label' => 'FeeCategory',
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
if($providerEnrollmentfee->totalCount){
    $gridColumnEnrollmentfee = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            [
                'attribute' => 'enrollment.id',
                'label' => 'Enrollment'
            ],
                        'amount',
            'discount',
            [
                'attribute' => 'discountType.description',
                'label' => 'DiscountType'
            ],
            ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerEnrollmentfee,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-enrollmentfee']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Enrollmentfee'),
        ],
        'columns' => $gridColumnEnrollmentfee
    ]);
}
?>

    </div>
    <div class="row">
        <h4>Feecategory<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnFeecategory = [
        ['attribute' => 'id', 'visible' => false],
        'description',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->feeCategory,
        'attributes' => $gridColumnFeecategory    ]);
    ?>
</div>
