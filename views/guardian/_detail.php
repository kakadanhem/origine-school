<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Guardian */

?>
<div class="guardian-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->id) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'forename',
        'surname',
        [
            'attribute' => 'gender.id',
            'label' => Yii::t('app', 'Gender'),
        ],
        'streetAddress',
        [
            'attribute' => 'province.id',
            'label' => Yii::t('app', 'Province'),
        ],
        [
            'attribute' => 'district.id',
            'label' => Yii::t('app', 'District'),
        ],
        [
            'attribute' => 'commune.id',
            'label' => Yii::t('app', 'Commune'),
        ],
        [
            'attribute' => 'village.id',
            'label' => Yii::t('app', 'Village'),
        ],
        'email:email',
        'mobile',
        'workplace',
        'position',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>