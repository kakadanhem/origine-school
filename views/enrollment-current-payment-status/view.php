<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\EnrollmentCurrentPaymentStatus */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Enrollment Current Payment Status', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enrollment-current-payment-status-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Enrollment Current Payment Status'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?= Html::a('Update', ['update', 'id' => $model->id, 'enrollment_id' => $model->enrollment_id, 'status_id' => $model->status_id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id, 'enrollment_id' => $model->enrollment_id, 'status_id' => $model->status_id], [
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
        'amount',
        [
            'attribute' => 'status.description',
            'label' => 'Status',
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
        'discountType_id',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->enrollment,
        'attributes' => $gridColumnEnrollment    ]);
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
        'model' => $model->status,
        'attributes' => $gridColumnAppendix    ]);
    ?>
</div>
