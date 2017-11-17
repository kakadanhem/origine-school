<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Enrollment */

?>
<div class="enrollment-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->id) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'enrollCode',
        [
            'attribute' => 'student.id',
            'label' => Yii::t('app', 'Student'),
        ],
        'enrollDate',
        [
            'attribute' => 'enrollType.id',
            'label' => Yii::t('app', 'EnrollType'),
        ],
        'discount',
        [
            'attribute' => 'discountType.id',
            'label' => Yii::t('app', 'DiscountType'),
        ],
        [
            'attribute' => 'grade.id',
            'label' => Yii::t('app', 'Grade'),
        ],
        [
            'attribute' => 'branch.id',
            'label' => Yii::t('app', 'Branch'),
        ],
        [
            'attribute' => 'payTerm.id',
            'label' => Yii::t('app', 'PayTerm'),
        ],
        [
            'attribute' => 'academicYear.id',
            'label' => Yii::t('app', 'AcademicYear'),
        ],
        [
            'attribute' => 'scheduleType.id',
            'label' => Yii::t('app', 'ScheduleType'),
        ],
        'snack',
        'lunch',
        [
            'attribute' => 'vanService.id',
            'label' => Yii::t('app', 'VanService'),
        ],
        'note:ntext',
        [
            'attribute' => 'paymentStatus.id',
            'label' => Yii::t('app', 'PaymentStatus'),
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