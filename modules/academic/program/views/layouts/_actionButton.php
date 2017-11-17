<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;
echo \kartik\nav\NavX::widget([
    'encodeLabels' => false,
    'options'=>['class'=>'action-button'],
    'items' => [
        [
            'label' => '<i class="paperfont action pixel60 paper-blackboard"></i>' . 'Programs',
            'active' => in_array(\Yii::$app->controller->id,['program']),
            'url' => 'index.php?r=program/program'],
        [
            'label' => '<i class="paperfont action pixel60 paper-whiteboard"></i>' . 'Curriculum',
            'active' => in_array(\Yii::$app->controller->id,['curriculum']),
            'url' => 'index.php?r=program/curriculum'],
        [
            'label' => '<i class="paperfont action pixel60 paper-library"></i>' . 'Grades',
            'active' => in_array(\Yii::$app->controller->id,['grade']),
            'url' => 'index.php?r=program/grade'],
        ]
]);
?>
