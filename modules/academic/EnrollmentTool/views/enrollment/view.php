<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Enrollment */

$this->title = 'Enrollment Code : ' . $model->enrollCode;
$this->params['breadcrumbs'][] = ['label' => 'Enrollment', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="enrollment-view">

    <div class="row">
        <div class="col-sm-6">
            <h2><?= Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-6" style="margin-top: 15px">
<?=
             Html::a('<i class="fa fa-file-pdf-o"></i> ' . 'PDF',
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => 'Will open the generated PDF file in a new window'
                ]
            )?>
            <?=
                $model->getPaymentExist() ? '' :
                Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
            ?>
            <?= $model->getPaymentExist() ? '' :
                Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
<?php
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
            'format' => 'html',
            'value' => function($model){
                return Html::a( $model->student->fullname,'index.php?r=people/student/view&id=' . $model->student_id);
            },
            'label' => 'Student',
        ],
        [
            'attribute' => 'branch.name',
            'label' => 'Branch',
        ],
        [
            'attribute' => 'grade.program.description',
            'label' => 'Program',
        ],
        [
            'attribute' => 'grade.description',
            'label' => 'Grade',
        ],
        'enrollDate',
        [
            'attribute' => 'enrollType.description',
            'label' => 'Enroll Type',
        ],
        [
            'attribute' => 'scheduleType.description',
            'label' => 'Schedule Type',
        ],
        [   'attribute' => 'discount.description',
            ],
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
        <?php
        if($providerEnrollmentFee->totalCount){
            $gridColumnEnrollmentFee = [
                ['class' => 'yii\grid\SerialColumn','headerOptions' =>['style'=>'width: 50px'],],
                ['attribute' => 'id', 'visible' => false],
                [
                    'attribute' => 'fee.description',
                    'label' => 'Fee',
                ],
                [
                    'attribute' => 'amount',
                    'format' => ['currency'],
                ],
                [   'attribute' => 'discount',
                    'value' => function($providerEnrollmentFee) {
                        if ($providerEnrollmentFee->is_amount == true) {
                            return Yii::$app->formatter->asCurrency($providerEnrollmentFee->discount);
                        } else {
                            return Yii::$app->formatter->asPercent($providerEnrollmentFee->discount / 100, 2);
                        }
                    }
                ],
                ['attribute' => 'lock', 'visible' => false],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'headerOptions' =>['style'=>'width: 30px'],
                    'template' => '{edit}',
                    'buttons' => [
                        'edit' => function($url, $model) {
                            return Html::a('<span class="fa fa-pencil"></span>', 'index.php?r=enrollment-tool/fee/update&id=' . $model->id, ['title' => 'Update']);
                        },
                    ]
                ],
            ];
            echo Gridview::widget([
                'dataProvider' => $providerEnrollmentFee,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-enrollment-fee']],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<i class="fa fa-credit-card-alt"></i> ' . Html::encode('Enrollment Fee'),
                ],
                'columns' => $gridColumnEnrollmentFee,
            ]);
        }
        ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php     $gridColumn = [
                ['class' => 'yii\grid\SerialColumn','headerOptions' =>['style'=>'width: 30px'],],
                ['attribute' => 'id', 'visible' => false],
                [   'attribute' =>'invoiceNo',
                    'headerOptions' =>['style'=>'width: 130px'],
                ],
                [   'attribute' => 'dueDate',
                    'headerOptions' =>['style'=>'width: 200px'],
                    'format' => ['date','d MMMM Y'],
                    'label' => 'Due Date',
                ],
                [   'label' => 'Total',
                    'headerOptions' =>['style'=>'width: 80px'],
                    'value' => function($invoice) {
                            return Yii::$app->formatter->asCurrency($invoice->totalAmount);
                         },
                ],
                [   'label' => 'Total Discount',
                    'headerOptions' =>['style'=>'width: 80px'],
                    'value' => function($invoice) {
                        return Yii::$app->formatter->asCurrency($invoice->totalDiscount);
                    },
                ],
                [   'label' => 'Paid',
                    'headerOptions' =>['style'=>'width: 80px'],
                    'value' => function($invoice) {
                        return Yii::$app->formatter->asCurrency($invoice->paidAmount);
                    },
                ],

                [
                    'attribute' => 'status_id',
                    'label' => Yii::t('app', 'Status'),
                    'headerOptions' =>['style'=>'width: 90px'],
                    'value' => function($invoice){
                        if ($invoice->status)
                        {return $invoice->status->title;}
                        else
                        {return NULL;}
                    },
                ],
                ['attribute' => 'lock', 'visible' => false],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'headerOptions' =>['style'=>'width: 50px'],
                    'template' => '{view-me}',
                    'buttons' => [
                        'view-me' => function($url, $model) {
                            return Html::a('<span class="fa fa-eye"></span>', 'index.php?r=finance/invoice/view&id=' . $model->id, ['title' => 'View']);
                         },
                    ],
                ],
            ];
            ?>
            <?= GridView::widget([
                'dataProvider' => $invoice,
                'columns' => $gridColumn,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-invoice']],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<span class="fa fa-money"></span>  ' . Yii::t('app','Invoices & Payments'),
                ],
            ]); ?>
        </div>
    </div>
</div>
