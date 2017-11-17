<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Schedule */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Schedule', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schedule-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Schedule'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'groupCourseDetail.id',
                'label' => 'GroupCourseDetail'
            ],
        [
                'attribute' => 'session.description',
                'label' => 'Session'
            ],
        [
                'attribute' => 'day.description',
                'label' => 'Day'
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
