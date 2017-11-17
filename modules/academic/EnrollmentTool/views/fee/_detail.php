<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\EnrollmentFee */

?>
<div class="enrollment-fee-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->id) ?></h2>
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
                if ($model->is_amount == true) {
                    return Yii::$app->formatter->asCurrency($model->discount);
                } else {
                    return Yii::$app->formatter->asPercent($model->discount / 100, 2);
                }
            },
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