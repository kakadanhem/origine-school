<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Term */

$this->title = 'Save As New Term: '. ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Term', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="term-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
