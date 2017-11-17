<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Invoice */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Invoice'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-view">

    <div class="row">
        <div class="col-sm-8">
            <h2><?= Yii::t('app', 'Invoice').' '. Html::encode($this->title) ?></h2>
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
        'invoiceNo',
        [
            'attribute' => 'enrollment.id',
            'label' => Yii::t('app', 'Enrollment'),
        ],
        'discount',
        [
            'attribute' => 'discountType.description',
            'label' => Yii::t('app', 'DiscountType'),
        ],
        [
            'attribute' => 'status.description',
            'label' => Yii::t('app', 'Status'),
        ],
        'dueDate',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
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
        <h4>Enrollment<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnEnrollment = [
        ['attribute' => 'id', 'visible' => false],
        'student_id',
        'enrollDate',
        'enrollType_id',
        'discount',
        [
            'attribute' => 'discountType.description',
            'label' => Yii::t('app', 'DiscountType'),
        ],
        'grade_id',
        'branch_id',
        'payTerm_id',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->enrollment,
        'attributes' => $gridColumnEnrollment    ]);
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
        'model' => $model->status,
        'attributes' => $gridColumnAppendix    ]);
    ?>
    
    <div class="row">
<?php
if($providerInvoiceitem->totalCount){
    $gridColumnInvoiceitem = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        [
                'attribute' => 'fee.description',
                'label' => Yii::t('app', 'Fee')
            ],
            'amount',
            'discount',
            [
                'attribute' => 'discountType.description',
                'label' => Yii::t('app', 'DiscountType')
            ],
            ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerInvoiceitem,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-invoiceitem']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Invoiceitem')),
        ],
        'columns' => $gridColumnInvoiceitem
    ]);
}
?>

    </div>
    
    <div class="row">
<?php
if($providerInvoicepayment->totalCount){
    $gridColumnInvoicepayment = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        'amount',
            ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerInvoicepayment,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-invoicepayment']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Invoicepayment')),
        ],
        'columns' => $gridColumnInvoicepayment
    ]);
}
?>

    </div>
</div>
