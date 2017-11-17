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
    <?php echo $this->render('//layouts/navigation',array('content' => $content)); ?>
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