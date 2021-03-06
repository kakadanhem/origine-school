<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Enrollment */

$this->title = 'Update Enrollment: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Enrollment', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="enrollment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formFee', [
        'model' => $model,
        'enrollCode' => $enrollCode,
    ]) ?>

</div>
