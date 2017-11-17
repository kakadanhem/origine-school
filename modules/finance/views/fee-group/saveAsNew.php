<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FeeGroup */

$this->title = 'Save As New Fee Group: '. ' ' . $model->description;
$this->params['breadcrumbs'][] = ['label' => 'Fee Group', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->description, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="fee-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
