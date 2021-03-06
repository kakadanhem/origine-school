<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Grade */

?>
<div class="grade-view">

    <div class="row">
        <div class="col-md-12">
            <h2><?= Html::encode($model->description) ?></h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'description',
        [
            'attribute' => 'program.description',
            'label' => 'Program',
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