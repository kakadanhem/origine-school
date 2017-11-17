<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\FeeGrade */

?>
<div class="fee-grade-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->description) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'description',
        'amount',
        [
            'attribute' => 'grade.description',
            'label' => Yii::t('app', 'Grade'),
        ],
        [
            'attribute' => 'type.description',
            'label' => Yii::t('app', 'Type'),
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