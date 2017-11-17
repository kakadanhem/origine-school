<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FeeGrouping */

$this->title = 'Create Fee Grouping';
$this->params['breadcrumbs'][] = ['label' => 'Fee Grouping', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fee-grouping-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
