<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Timetable */

$this->title = 'Save As New Timetable: '. ' ' . $model->description;
$this->params['breadcrumbs'][] = ['label' => 'Timetable', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->description, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="timetable-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
