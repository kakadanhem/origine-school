<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;

$this->beginBlock('action');?>
<?php echo \kartik\nav\NavX::widget([
    'encodeLabels' => false,
    'options'=>['class'=>'action-button'],
    'items' => [
            [
                'label' => '<i class="fa fa-user-o "></i>' . 'Students',
                'active' => in_array(\Yii::$app->controller->id,['student']),
                'url' => 'index.php?r=student'],
            [
                'label' => '<i class="fa fa-user-circle "></i>' . 'Teachers',
                'active' => in_array(\Yii::$app->controller->id,['teacher']), 'url' => 'index.php?r=teacher'],
            ['label' => '<i class="fa fa-user-circle-o "></i>' . 'Parents', 'active' => in_array(\Yii::$app->controller->id,['guardian']), 'url' => 'index.php?r=guardian'],
    ]
]);
?>
<?php $this->endBlock(); ?>
