<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Invoice */

?>
<div class="invoice-view">

    <div class="row">
        <div class="col-md-12">
            <h2><?= Html::encode($model->enrollment->title) ?></h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'invoiceNo',
        [
            'attribute' => 'enrollment.title',
            'label' => Yii::t('app', 'Enrollment'),
        ],
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
        [
            'attribute' => 'status.description',
            'label' => Yii::t('app', 'Status'),
        ],
        'dueDate',
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