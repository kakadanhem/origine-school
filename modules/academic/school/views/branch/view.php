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
<div class="branch-view">

    <?php
    if ($model->image_web!='') {
        echo '<br /><p><img class="branch-logo" src="'.Yii::$app->getUrlManager()->getBaseUrl(). '/uploads/branch/'.$model->image_web.'"></p>';
    }
    ?>
    <div class="row">
        <div class="col-sm-8">
            <h4><?= 'Branch :'.' '. Html::encode($this->title) ?></h4>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa fa-file-pdf-o"></i> ' . 'PDF',
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => 'Will open the generated PDF file in a new window'
                ]
            )?>
            <?= Html::a('Save As New', ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>            
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        [   'label' => 'Code Name',
            'value' => $model->shortName . ' - ' . $model->code,
        ],
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
</div>
