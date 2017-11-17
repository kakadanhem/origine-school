<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EnrollmentFee */

$this->title = 'Update Enrollment Fee: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Enrollment Fee', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="enrollment-fee-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
