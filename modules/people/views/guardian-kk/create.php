<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Guardian */

$this->title = 'Create Guardian';
$this->params['breadcrumbs'][] = ['label' => 'Guardian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_sideblock');?>

<div class="vf-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= \kartik\tabs\TabsX::widget([
    'position' => \kartik\tabs\TabsX::POS_ABOVE,
    'align' => \kartik\tabs\TabsX::ALIGN_LEFT,
    'items' => [
        [
            'label' => 'Address',
            'content' =>  $this->render('_formAddress', [
                'model' => $address,
            ]),
            'active' => true
        ],
        [
            'label' => 'Guardian',
            'content' => $this->render('_form', [
                'guardian' => $guardian,
                'address' => $address,
            ]),
            'headerOptions' => ['style'=>'font-weight:bold'],
        ],
        [
            'label' => 'Dropdown',
            'items' => [
                [
                    'label' => 'DropdownA',
                    'content' => 'DropdownA, Anim pariatur cliche...',
                ],
                [
                    'label' => 'DropdownB',
                    'content' => 'DropdownB, Anim pariatur cliche...',
                ],
            ],
        ],
    ],
]);?>

</div>
