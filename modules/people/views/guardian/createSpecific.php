<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Guardian */

$this->title = Yii::t('app', 'Create Guardian');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Guardian'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guardian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formSpecific', [
        'model' => $model,
    ]) ?>

</div>
