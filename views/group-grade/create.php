<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GroupGrade */

$this->title = 'Create Group Grade';
$this->params['breadcrumbs'][] = ['label' => 'Group Grade', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-grade-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
