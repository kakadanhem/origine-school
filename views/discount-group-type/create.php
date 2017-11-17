<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DiscountGroupType */

$this->title = Yii::t('app', 'Create Discount Group Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Discount Group Type'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discount-group-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
