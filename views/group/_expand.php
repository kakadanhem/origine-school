<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;
$items = [
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Group'),
        'content' => $this->render('_detail', [
            'model' => $model,
        ]),
    ],
        [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Enrollment'),
        'content' => $this->render('_dataEnrollment', [
            'model' => $model,
            'row' => $model->enrollments,
        ]),
    ],
                            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Groupcoursedetail'),
        'content' => $this->render('_dataGroupcoursedetail', [
            'model' => $model,
            'row' => $model->groupcoursedetails,
        ]),
    ],
    ];
echo TabsX::widget([
    'items' => $items,
    'position' => TabsX::POS_ABOVE,
    'encodeLabels' => false,
    'class' => 'tes',
    'pluginOptions' => [
        'bordered' => true,
        'sideways' => true,
        'enableCache' => false
    ],
]);
?>
