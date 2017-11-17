<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Fee */

$this->title = 'Create Fee';
$this->params['breadcrumbs'][] = ['label' => 'Fee', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
