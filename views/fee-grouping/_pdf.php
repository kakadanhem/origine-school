<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\FeeGrouping */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Fee Grouping', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fee-grouping-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Fee Grouping'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'fee.id',
                'label' => 'Fee'
            ],
        [
                'attribute' => 'feeGroup.id',
                'label' => 'FeeGroup'
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
