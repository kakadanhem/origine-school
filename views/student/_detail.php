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
            <h2><?= Html::encode($model->forenameEn) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'forenameEn',
        'surnameEn',
        'forenameKh',
        'surnameKh',
        'nickname',
        [
            'attribute' => 'gender.id',
            'label' => 'Gender',
        ],
        'birthdate',
        [
            'attribute' => 'nationality.id',
            'label' => 'Nationality',
        ],
        [
            'attribute' => 'religion.id',
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