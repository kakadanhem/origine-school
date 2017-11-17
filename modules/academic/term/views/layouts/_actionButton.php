<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;
echo \kartik\nav\NavX::widget([
    'encodeLabels' => false,
    'options'=>['class'=>'action-button'],
    'items' => [
        [
            'label' => '<i class="paperfont action pixel60 paper-calendar"></i>' . 'Academic Year',
            'active' => in_array(\Yii::$app->controller->id,['academic-year']),
            'url' => 'index.php?r=term/academic-year'],
        [
            'label' => '<i class="paperfont action pixel60 paper-calendar1"></i>' . 'Semester',
            'active' => in_array(\Yii::$app->controller->id,['semester']),
            'url' => 'index.php?r=term/semester'],
        [
            'label' => '<i class="paperfont action pixel60 paper-calendar2"></i>' . 'Term',
            'active' => in_array(\Yii::$app->controller->id,['term']),
            'url' => 'index.php?r=term/term'],
    ]
]);
?>
