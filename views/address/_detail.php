<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Address */

?>
<div class="address-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->streetAddress) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'streetAddress',
        [
            'attribute' => 'village.id',
            'label' => 'Village',
        ],
        [
            'attribute' => 'commune.id',
            'label' => 'Commune',
        ],
        [
            'attribute' => 'district.id',
            'label' => 'District',
        ],
        [
            'attribute' => 'province.id',
            'label' => 'Province',
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