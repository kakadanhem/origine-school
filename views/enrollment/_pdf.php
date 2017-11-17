<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Enrollment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Enrollment'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enrollment-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Enrollment').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'enrollCode',
        [
                'attribute' => 'student.id',
                'label' => Yii::t('app', 'Student')
            ],
        'enrollDate',
        [
                'attribute' => 'enrollType.id',
                'label' => Yii::t('app', 'EnrollType')
            ],
        'discount',
        [
                'attribute' => 'discountType.id',
                'label' => Yii::t('app', 'DiscountType')
            ],
        [
                'attribute' => 'grade.id',
                'label' => Yii::t('app', 'Grade')
            ],
        [
                'attribute' => 'branch.id',
                'label' => Yii::t('app', 'Branch')
            ],
        [
                'attribute' => 'payTerm.id',
                'label' => Yii::t('app', 'PayTerm')
            ],
        [
                'attribute' => 'academicYear.id',
                'label' => Yii::t('app', 'AcademicYear')
            ],
        [
                'attribute' => 'scheduleType.id',
                'label' => Yii::t('app', 'ScheduleType')
            ],
        'snack',
        'lunch',
        [
                'attribute' => 'vanService.id',
                'label' => Yii::t('app', 'VanService')
            ],
        'note:ntext',
        [
                'attribute' => 'paymentStatus.id',
                'label' => Yii::t('app', 'PaymentStatus')
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
if($providerEnrollmentcurrentpaymentstatus->totalCount){
    $gridColumnEnrollmentcurrentpaymentstatus = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
                'amount',
        [
                'attribute' => 'status.id',
                'label' => Yii::t('app', 'Status')
            ],
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerEnrollmentcurrentpaymentstatus,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Enrollmentcurrentpaymentstatus')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnEnrollmentcurrentpaymentstatus
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerEnrollmentfee->totalCount){
    $gridColumnEnrollmentfee = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
                [
                'attribute' => 'fee.id',
                'label' => Yii::t('app', 'Fee')
            ],
        'amount',
        'discount',
        [
                'attribute' => 'discountType.id',
                'label' => Yii::t('app', 'DiscountType')
            ],
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerEnrollmentfee,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Enrollmentfee')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnEnrollmentfee
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerEnrollmentpayment->totalCount){
    $gridColumnEnrollmentpayment = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
                'amount',
        [
                'attribute' => 'status.id',
                'label' => Yii::t('app', 'Status')
            ],
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerEnrollmentpayment,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Enrollmentpayment')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnEnrollmentpayment
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerInvoice->totalCount){
    $gridColumnInvoice = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'invoiceNo',
                'discount',
        [
                'attribute' => 'discountType.id',
                'label' => Yii::t('app', 'DiscountType')
            ],
        [
                'attribute' => 'status.id',
                'label' => Yii::t('app', 'Status')
            ],
        'dueDate',
        'term_id',
        'semester_id',
        [
                'attribute' => 'academicYear.id',
                'label' => Yii::t('app', 'AcademicYear')
            ],
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerInvoice,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('app', 'Invoice')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnInvoice
    ]);
}
?>
    </div>
</div>
