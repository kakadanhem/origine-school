<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Village */

$this->title = 'Create Village';
$this->params['breadcrumbs'][] = ['label' => 'Village', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="village-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
