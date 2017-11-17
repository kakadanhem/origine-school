<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Appendix */

$this->title = 'Save As New Appendix: '. ' ' . $model->description;
$this->params['breadcrumbs'][] = ['label' => 'Appendix', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->description, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="appendix-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
