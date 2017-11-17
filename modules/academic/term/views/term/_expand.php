<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;
$items = [
        [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Group'),
        'content' => $this->render('_dataGroup', [
            'model' => $model,
            'row' => $model->groups,
        ]),
    ],
        ];
echo TabsX::widget([
    'items' => $items,
    'position' => TabsX::POS_ABOVE,
    'encodeLabels' => false,
    'bordered' => true,
    'containerOptions' =>[
        'class' => 'origine-white-tab',
    ],
    'pluginOptions' => [
        'sideways' => true,
        'enableCache' => false
    ],
]);
?>
