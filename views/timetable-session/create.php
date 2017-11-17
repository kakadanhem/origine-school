<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TimetableSession */

$this->title = 'Create Timetable Session';
$this->params['breadcrumbs'][] = ['label' => 'Timetable Session', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timetable-session-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
