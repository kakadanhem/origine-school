<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Guardian */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Guardian',
]) . ' ' . $model->fullname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Guardian'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fullname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="guardian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
