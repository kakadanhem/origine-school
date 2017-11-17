<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EnrollmentPayment */

$this->title = \app\modules\academic\EnrollmentTool\EnrollmentTool::t('payment','Collect Payment');
$this->params['breadcrumbs'][] = ['label' => 'Enrollment', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="enrollment-payment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
