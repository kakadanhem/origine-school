<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Enrollment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Enrollment', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enrollment-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Enrollment'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'student.id',
                'label' => 'Student'
            ],
        [
                'attribute' => 'group.id',
                'label' => 'Group'
            ],
        'enrollDate',
        [
                'attribute' => 'enrollType.id',
                'label' => 'EnrollType'
            ],
        'discount',
        [
                'attribute' => 'discount.id',
                'label' => 'DiscountType'
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
