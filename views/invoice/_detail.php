<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Invoice */

?>
<div class="invoice-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->id) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'invoiceNo',
        [
            'attribute' => 'enrollment.id',
            'label' => Yii::t('app', 'Enrollment'),
        ],
        'discount',
        [
            'attribute' => 'discountType.description',
            'label' => Yii::t('app', 'DiscountType'),
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