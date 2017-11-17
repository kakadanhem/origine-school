<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Grade */

$this->title = 'Save As New Grade: '. ' ' . $model->description;
$this->params['breadcrumbs'][] = ['label' => 'Grade', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->description, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="grade-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
