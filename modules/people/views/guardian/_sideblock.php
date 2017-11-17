<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;

$this->beginBlock('sideblock'); ?>

<h4>Toolbar Menu</h4>
<ul class="side-block">
    <li><?= Html::a('<i class="fa fa-map pull-right"></i>Create Address', ['address/create']) ?></li>
    <li><?= Html::a('<i class="fa fa-map pull-right"></i>View Address', ['address/index']) ?></li>
</ul>
<?php $this->endBlock(); ?>
