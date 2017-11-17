<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DiscountDetail */

$this->title = Yii::t('app', 'Create Discount Detail');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Discount Detail'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discount-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
