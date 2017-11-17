<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\StudentGuardian */

?>
<div class="student-guardian-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->id) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'student.id',
            'label' => Yii::t('app', 'Student'),
        ],
        [
            'attribute' => 'guardian.id',
            'label' => Yii::t('app', 'Guardian'),
        ],
        [
            'attribute' => 'relationship.id',
            'label' => Yii::t('app', 'Relationship'),
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