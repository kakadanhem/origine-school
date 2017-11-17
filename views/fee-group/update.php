<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FeeGroup */

$this->title = 'Update Fee Group: ' . ' ' . $model->description;
$this->params['breadcrumbs'][] = ['label' => 'Fee Group', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->description, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fee-group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
