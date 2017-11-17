<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FeeGrade */

$this->title = Yii::t('app', 'Create Fee Grade');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fee Grade'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="fee-grade-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'feetypes' => $feetypes,
    ]) ?>

</div>
