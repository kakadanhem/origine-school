<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;

$this->beginBlock('action'); ?>
<ul class="action-button">
    <li><?= Html::a('<i class="fa fa-id-card center"></i><span>Create Enrollment</span>', ['create'], ['class'=>'action-hover']) ?></li>
    <li><?= Html::a('<i class="fa fa-id-card"></i><span>Mass Enrollment</span>', ['mass-index']) ?></li>
    <li><?= Html::a('<i class="fa fa-money center"></i><span>Enrollment Fee</span>', ['fee-assign']) ?></li>
    <li><?= Html::a('<i class="fa fa-money"></i><span>Mass Fee</span>', ['mass-fee-assign']) ?></li>
</ul>
<?php $this->endBlock(); ?>
