<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\InvoicePaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = Yii::t('app', 'Invoice Payment');
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="invoice-payment-index">

        <?= Html::a(Yii::t('app', 'Create Invoice Payment'), ['create'], ['class' => 'btn btn-success']) ?>
    <hr/>
    <?php 
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'invoiceNo',
                'label' => Yii::t('app', 'Invoice'),
                'value' => function($model){
                    if ($model->invoice)
                    {return $model->invoice->invoiceNo . ' - ' . $model->invoice->enrollment->student->forenameEn . ' ' . $model->invoice->enrollment->student->surnameEn ;}
                    else
                    {return NULL;}
                },
            ],
        [   'attribute' => 'amount',
            'headerOptions' =>['style'=>'width: 80px'],
            'value' => function($model) {
                return Yii::$app->formatter->asCurrency($model->amount);
            },
        ],
        [   'attribute' => 'created_at',
            'headerOptions' =>['style'=>'width: 150px'],
            'value' => function($model) {
                return Yii::$app->formatter->asDate($model->created_at);
            },
        ],
        ['attribute' => 'lock', 'visible' => false],
        [
            'class' => 'yii\grid\ActionColumn',
            'headerOptions' =>['style'=>'width: 120px'],
            'template' => '{save-as-new} {view} {update} {delete}',
            'buttons' => [
                'save-as-new' => function ($url) {
                    return Html::a('<span class="glyphicon glyphicon-copy"></span>', $url, ['title' => 'Save As New']);
                },
            ],
        ],
    ]; 
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-invoice-payment']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Full',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">Export All Data</li>',
                    ],
                ],
            ]) ,
        ],
    ]); ?>

</div>
