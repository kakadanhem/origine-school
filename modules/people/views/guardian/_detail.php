<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Guardian */

?>
<div class="guardian-view">

    <div class="row">
        <div class="col-sm-12">
            <h2><?= Html::encode($model->forename . ' ' . $model->surname) ?></h2>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
<?php

    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'gender.description',
            'label' => Yii::t('app', 'Gender'),
        ],
        [   'value' => function($model){
            return $model->streetAddress . ', <b>Phum:</b> ' . $model->village->name . ', <b>Khum:</b> ' . $model->commune->name .
                ',  <b>Srok:</b> ' .  $model->district->name . ',  <b>Khaet:</b> ' . $model->province->name;
            },
            'format' => 'html',
            'label' => Yii::t('app', 'address'),
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
</div>