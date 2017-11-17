<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;


/* @var $this yii\web\View */
/* @var $model app\models\Branch */
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Branch', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
if ($model->image_web!='') {
    echo '<br /><p><img class="branch-logo" src="'.Yii::$app->getUrlManager()->getBaseUrl(). '/uploads/branch/'.$model->image_web.'"></p>';
}
?>

<div class="branch-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Branch'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php
$gridColumn = [
    ['attribute' => 'id', 'visible' => false],
    'name',
    [
        'attribute' => 'streetAddress.streetAddress',
        'value' => $model->streetAddress->streetAddress . ', ' .
            \app\models\Village::find()->where(['id' => $model->streetAddress->village_id])->One()->name . ', ' .
            \app\models\Commune::find()->where(['id' => $model->streetAddress->commune_id])->One()->name . ', ' .
            \app\models\District::find()->where(['id' => $model->streetAddress->district_id])->One()->name. ', '  .
            \app\models\Province::find()->where(['id' => $model->streetAddress->province_id])->One()->name,
        'label' => 'StreetAddress',
    ],
    'telephone',
    'email:email',
    'website',
    [
        'attribute' => 'school.name',
        'label' => 'School',
    ],
    ['attribute' => 'lock', 'visible' => false],
];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
