<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;

$this->beginBlock('action'); ?>
<ul class="action-button">
    <li><?= Html::a('<i class="fa fa-building center"></i><span>School</span>', ['branch/create'], ['class'=>'action-hover']) ?></li>
    <li><?= Html::a('<i class="fa fa-building-o center"></i><span>Branch</span>', ['branch/index']) ?></li>
</ul>
<?php $this->endBlock(); ?>
