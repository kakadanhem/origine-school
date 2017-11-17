<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\School */

$this->title = 'Create School';
$this->params['breadcrumbs'][] = ['label' => 'School', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_sideblock') ?>

<div class="vf-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
