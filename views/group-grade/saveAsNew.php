<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GroupGrade */

$this->title = 'Save As New Group Grade: '. ' ' . $model->group_id;
$this->params['breadcrumbs'][] = ['label' => 'Group Grade', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->group_id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="group-grade-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
