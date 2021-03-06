<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EnrollmentFee */

$this->title = \app\modules\academic\EnrollmentTool\EnrollmentTool::t('Enrollment', 'Enrollment Fee');
$this->params['breadcrumbs'][] = ['label' => 'Enrollment Fee', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enrollment-fee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'feeData' => $feeData,
    ]) ?>

</div>
