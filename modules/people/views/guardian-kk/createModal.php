<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Guardian */

$this->title = 'Create Guardian';
$this->params['breadcrumbs'][] = ['label' => 'Guardian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guardian-create">

    <?= $this->render('_formModal', [
        'model' => $model,
    ]) ?>

</div>
