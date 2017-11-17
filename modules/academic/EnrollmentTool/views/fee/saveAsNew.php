<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EnrollmentFee */

$this->title = 'Save As New Enrollment Fee: '. ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Enrollment Fee', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="enrollment-fee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
