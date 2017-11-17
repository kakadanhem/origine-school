<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Appendix */

$this->title = 'Create Appendix';
$this->params['breadcrumbs'][] = ['label' => 'Appendix', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appendix-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
