<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Address */

$this->title = 'Save As New Address: '. ' ' . $model->streetAddress;
$this->params['breadcrumbs'][] = ['label' => 'Address', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->streetAddress, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="address-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
