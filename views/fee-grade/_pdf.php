<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\FeeGrade */

$this->title = $model->description;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fee Grade'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fee-grade-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Fee Grade').' '. Html::encode($this->title) ?></h2>
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
                'label' => Yii::t('app', 'Grade')
            ],
        [
                'attribute' => 'type.description',
                'label' => Yii::t('app', 'Type')
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
