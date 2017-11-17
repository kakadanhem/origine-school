<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EnrollmentCurrentPaymentStatus */

$this->title = 'Create Enrollment Current Payment Status';
$this->params['breadcrumbs'][] = ['label' => 'Enrollment Current Payment Status', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enrollment-current-payment-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
