<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EnrollmentPayment */

$this->title = 'Save As New Enrollment Payment: '. ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Enrollment Payment', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="enrollment-payment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
