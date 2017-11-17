<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\StudentGuardian */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Student Guardian'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-guardian-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Student Guardian').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'student.id',
                'label' => Yii::t('app', 'Student')
            ],
        [
                'attribute' => 'guardian.id',
                'label' => Yii::t('app', 'Guardian')
            ],
        [
                'attribute' => 'relationship.id',
                'label' => Yii::t('app', 'Relationship')
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
