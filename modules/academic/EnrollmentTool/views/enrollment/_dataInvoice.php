<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->invoices,
        'key' => 'id'
    ]);
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'invoiceNo',
            'label' => 'Invoice Number',
        ],
        [
            'attribute' => 'totalAmount',
            'format' => ['currency'],
        ],
        [
            'attribute' => 'status.description',
            'label' => 'Status',
        ],
        ['attribute' => 'lock', 'visible' => false],
        [
            'class' => 'yii\grid\ActionColumn',
            'headerOptions' =>['style'=>'width: 90px'],
            'template' => '{view}',
            'buttons' => [
                'view' => function ($model,$key) {
                    return \yii\helpers\Html::a('<span class="fa fa-eye"></span>',
                        'index.php?r=finance/invoice/view&id=' . $key->id, ['title' => 'View']);
                },
            ],
        ],
    ];
    
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'showFooter'=>TRUE,
        'containerOptions' => ['style' => 'overflow: auto'],
        'pjax' => true,
        'beforeHeader' => [
            [
                'options' => ['class' => 'skip-export']
            ]
        ],
        'export' => [
            'fontAwesome' => true
        ],
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'showPageSummary' => false,
        'persistResize' => false,
    ]);
