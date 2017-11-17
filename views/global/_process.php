<?php use yii\helpers\Html;
$this->beginBlock('process'); ?>
<ul class="process-arrow">
    <li><?= Html::a('1. Create Groups', ['group/create']) ?></li>
    <li><?= Html::a('2. Create Guardians', ['guardian/create']) ?></li>
    <li><?= Html::a('3. Create Students', ['student/create']) ?></li>
    <li><?= Html::a('4. Match Students to Guardians', ['student-guardian/create']) ?></li>
    <li><?= Html::a('5. Create Enrollments', ['enrollment/create']) ?></li>

</ul>
<?php $this->endBlock(); ?>