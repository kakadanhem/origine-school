<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FeeGrade */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Fee Grade',
]) . ' ' . $model->description;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fee Grade'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->description, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="fee-grade-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
