<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Group */

?>
<div class="group-view">

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
        [
            'attribute' => 'term.description',
            'label' => 'Term',
        ],
        [
            'attribute' => 'timetable.description',
            'label' => 'Timetable',
        ],
        [
            'attribute' => 'grade.description',
            'label' => 'Grade',
        ],
        [
            'attribute' => 'branch.id',
            'label' => 'Branch',
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