<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AppendixCategory */

$this->title = 'Update Appendix Category: ' . ' ' . $model->description;
$this->params['breadcrumbs'][] = ['label' => 'Appendix Category', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->description, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="appendix-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
