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
        <div class="col-sm-9">
            <h2><?= 'Fee'.' '. Html::encode($this->title) ?></h2>
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
                'label' => 'FeeCategory'
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
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Enrollmentfee'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnEnrollmentfee
    ]);
}
?>
    </div>
</div>
