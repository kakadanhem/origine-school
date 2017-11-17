<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FeeCategory */

$this->title = 'Save As New Fee Category: '. ' ' . $model->description;
$this->params['breadcrumbs'][] = ['label' => 'Fee Category', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->description, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="fee-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
