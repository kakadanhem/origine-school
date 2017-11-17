<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AppendixCategory */

$this->title = 'Create Appendix Category';
$this->params['breadcrumbs'][] = ['label' => 'Appendix Category', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appendix-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
