<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\InvoiceItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = Yii::t('app', 'Invoice Item');
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="invoice-item-index">

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
        [
                'attribute' => 'fee_id',
                'label' => Yii::t('app', 'Fee'),
                'value' => function($model){
                    if ($model->fee)
                    {return $model->fee->description;}
                    else
                    {return NULL;}
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => $feeData,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Fee', 'id' => 'grid-invoice-item-search-fee_id']
            ],
        [   'attribute' => 'amount',
            'headerOptions' =>['style'=>'width: 80px'],
            'value' => function($model) {
                    return Yii::$app->formatter->asCurrency($model->amount);
            },
        ],
        [   'attribute' => 'discount',
            'headerOptions' =>['style'=>'width: 80px'],
            'value' => function($model) {
                if ($model->is_amount == true) {
                    return Yii::$app->formatter->asCurrency($model->discount);
                } else {
                    return Yii::$app->formatter->asPercent($model->discount / 100, 2);
                }
            },
        ],
/*        [
                'attribute' => 'discountType_id',
                'label' => Yii::t('app', 'DiscountType'),
                'value' => function($model){
                    if ($model->discountType)
                    {return $model->discountType->description;}
                    else
                    {return NULL;}
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\Appendix::find()->asArray()->all(), 'id', 'description'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Appendix', 'id' => 'grid-invoice-item-search-discountType_id']
            ],*/
        ['attribute' => 'lock', 'visible' => false],
        [
            'class' => 'yii\grid\ActionColumn',
            'headerOptions' =>['style'=>'width: 90px'],
            'template' => '{save-as-new} {update} {delete}',
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
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-invoice-item']],
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
