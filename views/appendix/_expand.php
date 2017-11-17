<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;
$items = [
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Appendix'),
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
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Enrollmentfee'),
        'content' => $this->render('_dataEnrollmentfee', [
            'model' => $model,
            'row' => $model->enrollmentfees,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Guardian'),
        'content' => $this->render('_dataGuardian', [
            'model' => $model,
            'row' => $model->guardians,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Schedule'),
        'content' => $this->render('_dataSchedule', [
            'model' => $model,
            'row' => $model->schedules,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Staff'),
        'content' => $this->render('_dataStaff', [
            'model' => $model,
            'row' => $model->staff,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Student'),
        'content' => $this->render('_dataStudent', [
            'model' => $model,
            'row' => $model->students,
        ]),
    ],
            [
        'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode('Teacher'),
        'content' => $this->render('_dataTeacher', [
            'model' => $model,
            'row' => $model->teachers,
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
