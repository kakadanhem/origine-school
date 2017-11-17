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
        <div class="col-sm-9">
            <h2><?= 'Enrollment Fee'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'enrollment.id',
                'label' => 'Enrollment'
            ],
        [
                'attribute' => 'fee.id',
                'label' => 'Fee'
            ],
        'amount',
        'discount',
        [
                'attribute' => 'discountType.id',
                'label' => 'DiscountType'
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
