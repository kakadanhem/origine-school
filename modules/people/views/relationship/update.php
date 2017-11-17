<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StudentGuardian */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Relationship',
]) . ' ' . $model->student->fullname . ' and ' . $model->guardian->fullname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Relationship'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Relationship' . ' ' . $model->student->fullname . ' and ' . $model->guardian->fullname), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="student-guardian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
