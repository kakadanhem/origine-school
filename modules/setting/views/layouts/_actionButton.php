<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;
echo \kartik\nav\NavX::widget([
    'encodeLabels' => false,
    'options'=>['class'=>'action-button'],
    'items' => [
        [
            'label' => '<i class="paperfont action pixel60 paper-map "></i>' . 'Address',
            'active' => in_array(\Yii::$app->controller->id,['address']),
            'url' => 'index.php?r=setting/address'],
        [
            'label' => '<i class="paperfont action pixel60 paper-users"></i>' . 'Users',
            'active' => in_array(\Yii::$app->controller->id,['appendix']),
            'url' => 'index.php?r=setting/appendix'],
        [
            'label' => '<i class="paperfont action pixel60 paper-anchor"></i>' . 'Appendix',
            'active' => in_array(\Yii::$app->controller->id,['appendix']),
            'url' => 'index.php?r=setting/appendix'],
        [
            'label' => '<i class="paperfont action pixel60 paper-tool"></i>' . 'Config',
            'active' => in_array(\Yii::$app->controller->id,['appendix']),
            'url' => 'index.php?r=setting/configuration'],
        [
            'label' => '<i class="paperfont action pixel60 paper-tool1"></i>' . 'Gii',
            'active' => in_array(\Yii::$app->controller->id,['appendix']),
            'url' => 'index.php?r=setting/appendix'],
    ]
]);
?>
