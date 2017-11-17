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
        [
            'attribute' => 'enrollment.id',
            'label' => 'Enrollment',
        ],
        [
            'attribute' => 'fee.id',
            'label' => 'Fee',
        ],
        'amount',
        'discount',
        [
            'attribute' => 'discountType.id',
            'label' => 'DiscountType',
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
        'model' => $model->discountType,
        'attributes' => $gridColumnAppendix    ]);
    ?>
    <div class="row">
        <h4>Enrollment<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnEnrollment = [
        ['attribute' => 'id', 'visible' => false],
        'student_id',
        'group_id',
        'enrollDate',
        'enrollType_id',
        'discount',
        [
            'attribute' => 'discountType.id',
            'label' => 'DiscountType',
        ],
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
