<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;
$items = [
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Student'),
        'content' => $this->render('_detail', [
            'model' => $model,
        ]),
    ],
        [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Enrollments'),
        'content' => $this->render('_dataEnrollment', [
            'model' => $model,
            'row' => $model->enrollments,
        ]),
    ],
                        [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Guardians'),
        'content' => $this->render('_dataStudentguardian', [
            'model' => $model,
            'row' => $model->studentguardians,
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
