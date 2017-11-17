<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Commune */

$this->title = 'Save As New Commune: '. ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Commune', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="commune-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>