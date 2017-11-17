<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;
echo \kartik\nav\NavX::widget([
    'encodeLabels' => false,
    'options'=>['class'=>'action-button'],
    'items' => [
        [
            'label' => '<i class="paperfont action pixel60 paper-checklist"></i>' . 'Enrollment',
            'active' => in_array(\Yii::$app->controller->id,['enrollment']),
            'url' => 'index.php?r=enrollment-tool/enrollment'],
        [
            'label' => '<i class="paperfont action pixel60 paper-money"></i>' . 'Fees',
            'active' => in_array(\Yii::$app->controller->id,['fee']),
            'url' => 'index.php?r=enrollment-tool/fee'],
    ]
]);
?>
