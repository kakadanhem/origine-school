<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\EnrollmentFee */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Enrollment Fee', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enrollment-fee-view">

    <div class="row">
        <div class="col-sm-8">
            <h2><?= 'Enrollment Fee'.' '. Html::encode($this->title) ?></h2>
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
        [
            'attribute' => 'enrollment.id',
            'label' => 'Enrollment',
        ],
        [
            'attribute' => 'fee.id',
            'label' => 'Fee',
        ],
        'amount',
        [   'attribute' => 'discount',
            'headerOptions' =>['style'=>'width: 80px'],
            'value' => function($model) {
                if ($model->is_amount == '1') {
                    return Yii::$app->formatter->asCurrency($model->discount);
                } else {
                    return Yii::$app->formatter->asPercent($model->discount / 100, 0);
                }
            }],
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>

    <div class="row">
        <h4>Enrollment<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnEnrollment = [
        ['attribute' => 'id', 'visible' => false],
        'student_id',
        'grade_id',
        'branch_id',
        'enrollDate',
        'enrollType_id',
        ['attribute' => 'discount.title'],
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->enrollment,
        'attributes' => $gridColumnEnrollment    ]);
    ?>
    <div class="row">
        <h4>Fee<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnFee = [
        ['attribute' => 'id', 'visible' => false],
        'description',
        'amount',
        'feeCategory_id',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->fee,
        'attributes' => $gridColumnFee    ]);
    ?>
</div>
