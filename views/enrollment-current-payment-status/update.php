<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EnrollmentCurrentPaymentStatus */

$this->title = 'Update Enrollment Current Payment Status: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Enrollment Current Payment Status', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'enrollment_id' => $model->enrollment_id, 'status_id' => $model->status_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="enrollment-current-payment-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
