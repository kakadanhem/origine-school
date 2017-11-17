<?php

/* @var $this \yii\web\View */
/* @var $content string */
/* @var $sidebar string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use kartik\nav\NavX;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/uploads/origyn.png', ['class' => 'logo']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'bg-wet-asphalt navbar-fixed-top',
        ],
    ]);

    echo NavX::widget([
        'encodeLabels' => false,
        'options'=>['class'=>'navbar-nav navbar-right'],
        'items' => [
            ['label' => '<i class="fa fa-dashcube go-left"></i>' . 'Oriboard', 'url' => '#'],
            ['label' => '<i class="fa fa-users go-left"></i>' . 'People', 'active'=>true, 'items' => [
                ['label' => '<i class="fa fa-user-o go-left"></i>' . 'Students', 'url' => 'index.php?r=people/student'],
                ['label' => '<i class="fa fa-user-circle go-left"></i>' . 'Teachers', 'url' => 'index.php?r=people/teacher'],
                ['label' => '<i class="fa fa-user-circle-o go-left"></i>' . 'Parents', 'url' => 'index.php?r=people/guardian'],
            ]],
            ['label' => '<i class="fa fa-book go-left"></i>' . 'Academics', 'active'=>true, 'items' => [
                ['label' =>'<i class="fa fa-id-card go-left"></i>' . 'Enrollments', 'url' => 'index.php?r=enrollment-tool/enrollment/index'],
                '<li class="divider"></li>',
                ['label' => '<i class="fa fa-building go-left"></i>' . 'School Setting', 'items' => [
                    ['label' =>'<i class="fa fa-building go-left"></i>' . 'Schools', 'url' => 'index.php?r=school/school'],
                    ['label' =>'<i class="fa fa-building-o go-left"></i>' . 'Branches', 'url' => 'index.php?r=school/branch'],
                    '<li class="divider"></li>',
                    ['label' => 'Separated link', 'url' => '#'],
                ]],
                ['label' => '<i class="fa fa-gear go-left"></i>' . 'Program Setting', 'items' => [
                    ['label' =>'<i class="fa fa-th-large go-left"></i>' . 'Programs', 'url' => 'index.php?r=program/program'],
                    ['label' =>'<i class="fa fa-th go-left"></i>' . 'Grades', 'url' => 'index.php?r=program/grade'],
                    ['label' =>'<i class="fa fa-th go-left"></i>' . 'Groups', 'url' => 'index.php?r=program/group'],
                    '<li class="divider"></li>',
                    ['label' => 'Separated link', 'url' => '#'],
                ]],
                ['label' => '<i class="fa fa-gear go-left"></i>' . 'Term Setting', 'items' => [
                    ['label' => '<i class="fa fa-braille go-left"></i>' .'Academic Year', 'url' => 'index.php?r=term/academic-year'],
                    ['label' => '<i class="fa fa-circle-o-notch go-left"></i>' . 'Semester', 'url' => 'index.php?r=term/semester'],
                    ['label' => '<i class="fa fa-circle-o-notch go-left"></i>' . 'Term', 'url' => 'index.php?r=term/term'],
                    '<li class="divider"></li>',
                    ['label' => 'Separated link', 'url' => '#'],
                ]],
            ]],
            ['label' => '<i class="fa fa-money go-left"></i>' . 'Finance', 'items' => [
                ['label' =>'<i class="fa fa-dot-circle-o go-left"></i>' . 'Fee Category', 'url' => 'index.php?r=finance/fee-category'],
                ['label' =>'<i class="fa fa-dot-circle-o go-left"></i>' . 'Fee', 'url' => 'index.php?r=finance/fee'],
                ['label' =>'<i class="fa fa-dot-circle-o go-left"></i>' . 'Fee Group', 'url' => 'index.php?r=finance/fee-group'],
                ['label' =>'<i class="fa fa-dot-circle-o go-left"></i>' . 'Fee Grouping', 'url' => 'index.php?r=finance/fee-grouping'],
                '<li class="divider"></li>',
                ['label' => '<i class="fa fa-pie-chart go-left"></i>' . 'Reporting', 'url' => '#'],
            ]],
            ['label' =>'<i class="fa fa-gears go-left"></i>' . 'Setting', 'active'=>true, 'items' => [
                ['label' =>'<i class="fa fa-map go-left"></i>' . 'Address', 'url' => 'index.php?r=setting/address'],
                ['label' =>'<i class="fa fa-question-circle go-left"></i>' . 'Appendix', 'url' => 'index.php?r=setting/appendix'],
                '<li class="divider"></li>',
                ['label' => 'Gii Tool', 'url' => 'index.php?r=gii'],
            ]],
            '<li class="divider"></li>',
            Yii::$app->user->isGuest ? (
            ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            ),
        ]
    ]);
    NavBar::end();
    ?>
    <div class="action-row">
        <div class="container">
            <?= $this->render('_actionButton');?>
        </div>
    </div>

    <div class="container">

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?php if (isset($this->blocks['process'])): ?>
            <?= $this->blocks['process'] ?>
        <?php else: ?>
        <?php endif; ?>

        <div class="row">

            <?php if (isset($this->blocks['sideblock'])): ?>
                <div class="col-md-3 side-block">
                    <?= $this->blocks['sideblock'] ?>
                </div>
                <div class="col-md-9 contentblock"><?= $content ?></div>
            <?php else: ?>
                <div class="col-md-12 contentblock"><?= $content ?></div>
            <?php endif; ?>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Origine School Management Information System <?= date('Y') ?></p>

        <p class="pull-right"><?= 'Proudly built with Yii2' ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>