<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GroupCourseDetail */

$this->title = 'Save As New Group Course Detail: '. ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Group Course Detail', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="group-course-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
