<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FeeGroup */

$this->title = 'Create Fee Group';
$this->params['breadcrumbs'][] = ['label' => 'Fee Group', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fee-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
