<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Discount */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Discount'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discount-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Discount').' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
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
        <div class="col-md-12">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'title',
        'description',
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
            if($providerDiscountdetail->totalCount){
                $gridColumnDiscountdetail = [
                    ['class' => 'yii\grid\SerialColumn', 'headerOptions' => ['style' => 'width: 40px']],
                        ['attribute' => 'id', 'visible' => false],
                                    [
                            'attribute' => 'feeCategory.description',
                            'label' => Yii::t('app', 'Fee')
                        ],
                    [   'attribute' => 'value',
                        'headerOptions' =>['style'=>'width: 80px'],
                        'value' => function($model) {
                            if ($model->isamount == '1') {
                                return Yii::$app->formatter->asCurrency($model->value);
                            } else {
                                return Yii::$app->formatter->asPercent($model->value / 100, 0);
                            }
                        }],
                        ['attribute' => 'lock', 'visible' => false],
                ];
                echo Gridview::widget([
                    'dataProvider' => $providerDiscountdetail,
                    'pjax' => true,
                    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-discountdetail']],
                    'panel' => [
                        'type' => GridView::TYPE_PRIMARY,
                        'heading' => '<span class="paperfont left pixel20 paper-voucher"></span> ' . Html::encode(Yii::t('app', 'Detail')),
                    ],
                    'export' => false,
                    'columns' => $gridColumnDiscountdetail
                ]);
            }
            ?>
        </div>
    </div>
</div>
