<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StudentGuardian */

$this->title = Yii::t('app', 'Create Student Guardian');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Student Guardian'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-guardian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formQuick', [
        'model' => $model,
        'student' => $student,
        'guardian' => $guardian,
    ]) ?>

</div>
