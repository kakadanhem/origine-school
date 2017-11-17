<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;

$this->beginBlock('sideblock'); ?>

<h4>Toolbar Menu</h4>
<ul class="side-block">
    <li><?= Html::a('<i class="fa fa-building pull-right"></i>Create School', ['school/create']) ?></li>
    <li><?= Html::a('<i class="fa fa-building pull-right"></i>View School', ['school/index']) ?></li>
</ul>
<?php $this->endBlock(); ?>
