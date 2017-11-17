<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;

$this->beginBlock('sideblock'); ?>

<h4>Toolbar Menu</h4>
<ul class="side-block">
    <li><?= Html::a('<i class="fa fa-building pull-right"></i>Create Branch', ['branch/create']) ?></li>
    <li><?= Html::a('<i class="fa fa-building pull-right"></i>View Branches', ['branch/index']) ?></li>
</ul>
<?php $this->endBlock(); ?>
