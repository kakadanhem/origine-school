<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Enrollment */

?>
<div class="enrollment-view">

    <div class="row">
        <div class="col-md-12">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'enrollCode',
            'label' => 'Code',
        ],
        [
            'value' => $fullname,
            'label' => 'Student',
        ],
        [
            'attribute' => 'student.gender.description',
            'label' => 'Student',
        ],
        [
            'attribute' => 'grade.description',
            'label' => 'Grade',
        ],
        'enrollDate',
        [
            'attribute' => 'enrollType.description',
            'label' => 'Enroll Type',
        ],
        [
            'attribute' => 'scheduleType.description',
            'label' => 'Schedule Type',
        ],
        [   'attribute' => 'discount.description',],
        [
            'attribute' => 'paymentStatus.title',
            'label' => 'Payment Status',
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