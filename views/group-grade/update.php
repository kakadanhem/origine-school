<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GroupGrade */

$this->title = 'Update Group Grade: ' . ' ' . $model->group_id;
$this->params['breadcrumbs'][] = ['label' => 'Group Grade', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->group_id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="group-grade-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
