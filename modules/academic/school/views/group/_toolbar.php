<?php
use yii\helpers\Html;
$this->beginBlock('sideblock'); ?>
    <h4>Toolkits</h4>
    <ul class="side-block">
        <li><?= Html::a('<i class="fa fa-id-card pull-right"></i>Create Enrollment', ['enrollment/create']) ?></li>
        <li><?= Html::a('<i class="fa fa-book pull-right"></i>Create Course', ['course/create']) ?></li>
        <li><?= Html::a('<i class="fa fa-user-circle pull-right"></i>Create Teacher', ['teacher/create']) ?></li>
        <li><?= Html::a('<i class="fa fa-bandcamp pull-right"></i>Create Grade', ['grade/create']) ?></li>
        <li><?= Html::a('<i class="fa fa-calendar pull-right"></i>Create Timetable', ['timetable/create']) ?></li>
        <li><?= Html::a('<i class="fa fa-calendar-o pull-right"></i>Create Term', ['term/create']) ?></li>
    </ul>
<?php $this->endBlock(); ?>