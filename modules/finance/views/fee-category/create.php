<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FeeCategory */

$this->title = 'Create Fee Category';
$this->params['breadcrumbs'][] = ['label' => 'Fee Category', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fee-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
