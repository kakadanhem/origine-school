<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FeeCategory */

$this->title = 'Update Fee Category: ' . ' ' . $model->description;
$this->params['breadcrumbs'][] = ['label' => 'Fee Category', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->description, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fee-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
