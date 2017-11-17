<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GroupCourseDetail */

$this->title = 'Create Group Course Detail';
$this->params['breadcrumbs'][] = ['label' => 'Group Course Detail', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-course-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
