<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FeeGrade */

$this->title = Yii::t('app', 'Save As New {modelClass}: ', [
    'modelClass' => 'Fee Grade',
]). ' ' . $model->description;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fee Grade'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->description, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Save As New');
?>
<div class="fee-grade-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
