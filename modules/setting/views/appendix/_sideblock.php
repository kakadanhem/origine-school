<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;

$this->beginBlock('sideblock'); ?>

<h4>Toolkits</h4>
<ul class="side-block">
    <li><?= Html::a('<i class="fa fa-question-circle pull-right"></i>Create Appendix Category', ['appendix-category/create']) ?></li>
    <li><?= Html::a('<i class="fa fa-question-circle-o pull-right"></i>View Appendix Category', ['appendix-category/index']) ?></li>
</ul>
<?php $this->endBlock(); ?>
