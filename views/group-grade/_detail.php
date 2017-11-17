<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\GroupGrade */

?>
<div class="group-grade-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->group_id) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'grade.id',
            'label' => 'Grade',
        ],
        [
            'attribute' => 'group.id',
            'label' => 'Group',
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