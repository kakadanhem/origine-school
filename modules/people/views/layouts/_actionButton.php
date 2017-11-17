<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;
echo \kartik\nav\NavX::widget([
    'encodeLabels' => false,
    'options'=>['class'=>'action-button'],
    'items' => [
        [
            'label' => '<i class="paperfont action pixel60 paper-learning"></i>' . 'Student',
            'active' => in_array(\Yii::$app->controller->id,['student']),
            'url' => 'index.php?r=people/student'],
        [
            'label' => '<i class="paperfont action pixel60 paper-mother"></i>' . 'Guardian',
            'active' => in_array(\Yii::$app->controller->id,['guardian']),
            'url' => 'index.php?r=people/guardian'],
        [
            'label' => '<i class="paperfont action pixel60 paper-teacher"></i>' . 'Teacher',
            'active' => in_array(\Yii::$app->controller->id,['teacher']),
            'url' => 'index.php?r=people/teacher'],
        [
            'label' => '<i class="paperfont action pixel60 paper-learning1"></i>' . 'Relationship',
            'active' => in_array(\Yii::$app->controller->id,['relationship']),
            'url' => 'index.php?r=people/relationship'],
    ]
]);
?>
