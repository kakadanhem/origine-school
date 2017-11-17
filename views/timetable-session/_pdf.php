<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\TimetableSession */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Timetable Session', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timetable-session-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Timetable Session'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'session.id',
                'label' => 'Session'
            ],
        [
                'attribute' => 'timetable.id',
                'label' => 'Timetable'
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
