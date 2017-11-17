<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Student */

?>
<div class="student-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->allFullname) ?></h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'gender.description',
            'label' => 'Gender',
        ],
        'birthdate',
        [
            'attribute' => 'nationality.nationality',
            'label' => 'Nationality',
        ],
        [
            'attribute' => 'religion.description',
            'label' => 'Religion',
        ],
        'passportNo',
        'passportExpire',
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