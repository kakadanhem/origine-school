<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Enrollment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Enrollment'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enrollment-view">

    <div class="row">
        <div class="col-sm-8">
            <h2><?= Yii::t('app', 'Enrollment').' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa fa-file-pdf-o"></i> ' . Yii::t('app', 'PDF'), 
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => Yii::t('app', 'Will open the generated PDF file in a new window')
                ]
            )?>
            <?= Html::a(Yii::t('app', 'Save As New'), ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>            
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'enrollCode',
        [
            'attribute' => 'student.id',
            'label' => Yii::t('app', 'Student'),
        ],
        'enrollDate',
        [
            'attribute' => 'enrollType.id',
            'label' => Yii::t('app', 'EnrollType'),
        ],
        'discount',
        [
            'attribute' => 'discountType.id',
            'label' => Yii::t('app', 'DiscountType'),
        ],
        [
            'attribute' => 'grade.id',
            'label' => Yii::t('app', 'Grade'),
        ],
        [
            'attribute' => 'branch.id',
            'label' => Yii::t('app', 'Branch'),
        ],
        [
            'attribute' => 'payTerm.id',
            'label' => Yii::t('app', 'PayTerm'),
        ],
        [
            'attribute' => 'academicYear.id',
            'label' => Yii::t('app', 'AcademicYear'),
        ],
        [
            'attribute' => 'scheduleType.id',
            'label' => Yii::t('app', 'ScheduleType'),
        ],
        'snack',
        'lunch',
        [
            'attribute' => 'vanService.id',
            'label' => Yii::t('app', 'VanService'),
        ],
        'note:ntext',
        [
            'attribute' => 'paymentStatus.id',
            'label' => Yii::t('app', 'PaymentStatus'),
        ],
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4>Academicyear<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnAcademicyear = [
        ['attribute' => 'id', 'visible' => false],
        'description',
        'active',
        'startDate',
        'endDate',
        'days',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->academicYear,
        'attributes' => $gridColumnAcademicyear    ]);
    ?>
    <div class="row">
        <h4>Branch<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnBranch = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'shortName',
        'streetAddress_id',
        'telephone',
        'email',
        'website',
        'image_src',
        'image_web',
        'school_id',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->branch,
        'attributes' => $gridColumnBranch    ]);
    ?>
    <div class="row">
        <h4>Appendix<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnAppendix = [
        ['attribute' => 'id', 'visible' => false],
        'title',
        'description',
        'appendixCategory_id',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->discountType,
        'attributes' => $gridColumnAppendix    ]);
    ?>
    <div class="row">
        <h4>Grade<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnGrade = [
        ['attribute' => 'id', 'visible' => false],
        'description',
        'program_id',
        'curriculum_id',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->grade,
        'attributes' => $gridColumnGrade    ]);
    ?>
    <div class="row">
        <h4>Appendix<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnAppendix = [
        ['attribute' => 'id', 'visible' => false],
        'title',
        'description',
        'appendixCategory_id',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->paymentStatus,
        'attributes' => $gridColumnAppendix    ]);
    ?>
    <div class="row">
        <h4>Appendix<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnAppendix = [
        ['attribute' => 'id', 'visible' => false],
        'title',
        'description',
        'appendixCategory_id',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->payTerm,
        'attributes' => $gridColumnAppendix    ]);
    ?>
    <div class="row">
        <h4>Appendix<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnAppendix = [
        ['attribute' => 'id', 'visible' => false],
        'title',
        'description',
        'appendixCategory_id',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->scheduleType,
        'attributes' => $gridColumnAppendix    ]);
    ?>
    <div class="row">
        <h4>Student<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnStudent = [
        ['attribute' => 'id', 'visible' => false],
        'studentCode',
        'forenameEn',
        'surnameEn',
        'forenameKh',
        'surnameKh',
        'nickname',
        'gender_id',
        'birthdate',
        'nationality_id',
        'religion_id',
        'passportNo',
        'passportExpire',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->student,
        'attributes' => $gridColumnStudent    ]);
    ?>
    <div class="row">
        <h4>Appendix<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnAppendix = [
        ['attribute' => 'id', 'visible' => false],
        'title',
        'description',
        'appendixCategory_id',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->enrollType,
        'attributes' => $gridColumnAppendix    ]);
    ?>
    <div class="row">
        <h4>Appendix<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnAppendix = [
        ['attribute' => 'id', 'visible' => false],
        'title',
        'description',
        'appendixCategory_id',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->vanService,
        'attributes' => $gridColumnAppendix    ]);
    ?>
    
    <div class="row">
<?php
if($providerEnrollmentcurrentpaymentstatus->totalCount){
    $gridColumnEnrollmentcurrentpaymentstatus = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        'amount',
            [
                'attribute' => 'status.id',
                'label' => Yii::t('app', 'Status')
            ],
            ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerEnrollmentcurrentpaymentstatus,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-enrollmentcurrentpaymentstatus']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Enrollmentcurrentpaymentstatus')),
        ],
        'columns' => $gridColumnEnrollmentcurrentpaymentstatus
    ]);
}
?>

    </div>
    
    <div class="row">
<?php
if($providerEnrollmentfee->totalCount){
    $gridColumnEnrollmentfee = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        [
                'attribute' => 'fee.id',
                'label' => Yii::t('app', 'Fee')
            ],
            'amount',
            'discount',
            [
                'attribute' => 'discountType.id',
                'label' => Yii::t('app', 'DiscountType')
            ],
            ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerEnrollmentfee,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-enrollmentfee']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Enrollmentfee')),
        ],
        'columns' => $gridColumnEnrollmentfee
    ]);
}
?>

    </div>
    
    <div class="row">
<?php
if($providerEnrollmentpayment->totalCount){
    $gridColumnEnrollmentpayment = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        'amount',
            [
                'attribute' => 'status.id',
                'label' => Yii::t('app', 'Status')
            ],
            ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerEnrollmentpayment,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-enrollmentpayment']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Enrollmentpayment')),
        ],
        'columns' => $gridColumnEnrollmentpayment
    ]);
}
?>

    </div>
    
    <div class="row">
<?php
if($providerInvoice->totalCount){
    $gridColumnInvoice = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            'invoiceNo',
                        'discount',
            [
                'attribute' => 'discountType.id',
                'label' => Yii::t('app', 'DiscountType')
            ],
            [
                'attribute' => 'status.id',
                'label' => Yii::t('app', 'Status')
            ],
            'dueDate',
            'term_id',
            'semester_id',
            [
                'attribute' => 'academicYear.id',
                'label' => Yii::t('app', 'AcademicYear')
            ],
            ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerInvoice,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-invoice']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Invoice')),
        ],
        'columns' => $gridColumnInvoice
    ]);
}
?>

    </div>
</div>
