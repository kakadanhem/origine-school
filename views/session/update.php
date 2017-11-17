<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Session */

$this->title = 'Update Session: ' . ' ' . $model->description;
$this->params['breadcrumbs'][] = ['label' => 'Session', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->description, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="session-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
