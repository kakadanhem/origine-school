<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\GroupGrade */

$this->title = $model->group_id;
$this->params['breadcrumbs'][] = ['label' => 'Group Grade', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-grade-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Group Grade'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'grade.id',
                'label' => 'Grade'
            ],
        [
                'attribute' => 'group.id',
                'label' => 'Group'
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
