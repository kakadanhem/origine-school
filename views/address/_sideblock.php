<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;

$this->beginBlock('sideblock'); ?>

<h4>Toolbar Menu</h4>
<ul class="side-block">
    <li><?= Html::a('<i class="fa fa-user-circle-o pull-right"></i>Create Guardian', ['guardian/create']) ?></li>
    <li><?= Html::a('<i class="fa fa-building-o pull-right"></i>Create Branch', ['branch/index']) ?></li>
</ul>
<?php $this->endBlock(); ?>
