<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;
echo \kartik\nav\NavX::widget([
    'encodeLabels' => false,
    'options'=>['class'=>'action-button'],
    'items' => [
        [
            'label' => '<i class="paperfont action pixel60 paper-school1"></i>' . 'School',
            'active' => in_array(\Yii::$app->controller->id,['school']),
            'url' => 'index.php?r=school/school'],
        [
            'label' => '<i class="paperfont action pixel60 paper-school"></i>' . 'Branch',
            'active' => in_array(\Yii::$app->controller->id,['branch']),
            'url' => 'index.php?r=school/branch'],
    ]
]);
?>
