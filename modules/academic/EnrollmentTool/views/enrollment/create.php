<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Enrollment */

$this->title = 'Create Enrollment';
$this->params['breadcrumbs'][] = ['label' => 'Enrollment', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vf-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
        'feesArray' => $feesArray,
        'branch' => $branch,

    ]) ?>

</div>
