<?php
use yii\helpers\Html ;
use yii\bootstrap\NavBar;
use kartik\nav\NavX;
use machour\yii2\notifications\widgets\NotificationsWidget;
$year = \app\models\AcademicYear::find()->where(['active' => true])->one();
?>
<nav class="headbar navbar-fixed-top">
    <div class="container">
        <span class="current-ay">
            <?php echo Yii::$app->user->isGuest ? '' :
                ($year == NULL ? '<h5 style="background:red;padding:5px;">You must at least has one <b>ACTIVE</b> academic year!</h5>' :
                    'Academic Year : ' . $year->description
                );
            ?>
    </span>
    <ul class="dropdown notifications-menu">
        <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="paperfont pixel15 paper-alert"></i>
                <span class="label label-warning notifications-icon-count">0</span>
            </a>
            <ul class="notification dropdown-menu">
                <li class="header">You have <span class="notifications-header-count">0</span> notifications</li>
                <li>
                    <ul class="notimenu">
                        <div id="notifications"></div>
                    </ul>
                </li>
                <li class="notifooter"><span><a href="#">View all</a> / <a href="#" id="notification-seen-all">Mark all as seen</a></span></li>
            </ul>
        </li>
    </ul>
        <div class="top-user">
        <?php
        if (Yii::$app->user->isGuest){
            echo Html::a('Login','/user/security/login');
        }
        else {
            echo Html::beginForm(['/user/security/logout'], 'post');
            echo Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
               );
            echo Html::endForm();
        }
        ?>
        </div>
    </div>
</nav>


<?php
NavBar::begin([
    'brandLabel' => Html::img('@web/uploads/origyn.png', ['class' => 'logo']),
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'bg-wet-asphalt navbar-fixed-top second navbar',
    ],
]);
$auth = \Yii::$app->authManager;
$financeRole = $auth->getRole('finance-staff');
$guest = [];
$items = [];
$home = [
    ['label' => '<i class="paperfont left pixel15 paper-speedometer "></i>' . 'Oriboard', 'url' => 'index.php?r=origine-board'],
];


$frontdesk = [
    ['label' => '<i class="paperfont left pixel15 paper-checklist "></i>' . 'Enrollment', 'url' => 'index.php?r=enrollment-tool/enrollment/index'],
    '<li class="divider"></li>',
    ['label' => '<i class="paperfont left pixel15 paper-invoice2 "></i>' . 'Invoice', 'url' => 'index.php?r=finance/invoice/index'],
    '<li class="divider"></li>',
    ['label' => '<i class="paperfont left pixel15 paper-learning "></i>' . 'Students', 'url' => 'index.php?r=people/student'],
    ['label' => '<i class="paperfont left pixel15 paper-mother "></i>' . 'Parents', 'url' => 'index.php?r=people/guardian'],
    ['label' => '<i class="paperfont left pixel15 paper-learning1 "></i>' . 'Relation', 'url' => 'index.php?r=people/relationship'],
];

$finance = [
    ['label' => '<i class="paperfont left pixel15 paper-moneybag "></i>' . 'Finance', 'items' => [
        ['label' => '<i class="paperfont left pixel15 paper-money"></i>' . 'Fee', 'items' => [
            ['label' =>'<i class="paperfont left pixel15 paper-money1"></i>' . 'All Fee', 'url' => 'index.php?r=finance/fee'],
            ['label' =>'<i class="paperfont left pixel15 paper-moneybag"></i>' . 'Fee Categeory', 'url' => 'index.php?r=finance/fee-category'],
            ['label' =>'<i class="paperfont left pixel15 paper-discount"></i>' . 'Discount', 'url' => 'index.php?r=finance/discount'],
        ]],
        ['label' => '<i class="paperfont left pixel15 paper-invoice2"></i>' . 'Invoice', 'items' => [
            ['label' =>'<i class="paperfont left pixel15 paper-invoice2"></i>' . 'Invoice', 'url' => 'index.php?r=finance/invoice'],
            ['label' =>'<i class="paperfont left pixel15 paper-shoppingbag"></i>' . 'Invoice Items', 'url' => 'index.php?r=finance/invoice-item'],
            ['label' =>'<i class="paperfont left pixel15 paper-creditcard"></i>' . 'Payments', 'url' => 'index.php?r=finance/invoice-payment'],
        ]],
        ['label' =>'<i class="paperfont left pixel15 paper-money"></i>' . 'Enrollment Fee', 'url' => 'index.php?r=finance/enrollment-fee'],

        ['label' =>'<i class="paperfont left pixel15 paper-voucher2"></i>' . 'Group Discount', 'url' => 'index.php?r=finance/discount-group'],
        '<li class="divider"></li>',
        ['label' => '<i class="paperfont left pixel15 paper-piechart"></i>' . 'Reporting', 'url' => '#'],
    ]],
];
$people = [['label' => '<i class="paperfont left pixel15 paper-learning"></i>' . 'People', 'active'=>true, 'items' => [
    ['label' => '<i class="paperfont left pixel15 paper-learning"></i>' . 'Students', 'url' => 'index.php?r=people/student'],
    ['label' => '<i class="paperfont left pixel15 paper-mother"></i>' . 'Guardians', 'url' => 'index.php?r=people/guardian'],
    ['label' => '<i class="paperfont left pixel15 paper-teacher"></i>' . 'Teachers', 'url' => 'index.php?r=people/teacher'],
    ['label' => '<i class="paperfont left pixel15 paper-learning1"></i>' . 'Relationship', 'url' => 'index.php?r=people/relationship'],
]],];
$academic = [
    ['label' => '<i class="paperfont left pixel15 paper-book"></i>' . 'Academics', 'active'=>true, 'items' => [
        ['label' =>'<i class="paperfont left pixel15 paper-checklist"></i>' . 'Enrollments', 'url' => 'index.php?r=enrollment-tool/enrollment/index'],
        '<li class="divider"></li>',
        ['label' =>'<i class="paperfont left pixel15 paper-grade"></i>' . 'Groups', 'url' => 'index.php?r=school/group'],
        ['label' => '<i class="paperfont left pixel15 paper-school1"></i>' . 'School Setting', 'items' => [
            ['label' =>'<i class="paperfont left pixel15 paper-school1"></i>' . 'Schools', 'url' => 'index.php?r=school/school'],
            ['label' =>'<i class="paperfont left pixel15 paper-school"></i>' . 'Branches', 'url' => 'index.php?r=school/branch'],
        ]],
        ['label' => '<i class="paperfont left pixel15 paper-blackboard"></i>' . 'Program', 'items' => [
            ['label' =>'<i class="paperfont left pixel15 paper-blackboard"></i>' . 'Programs', 'url' => 'index.php?r=program/program'],
            ['label' =>'<i class="paperfont left pixel15 paper-whiteboard"></i>' . 'Curriculums', 'url' => 'index.php?r=program/curriculum'],
            ['label' =>'<i class="paperfont left pixel15 paper-library"></i>' . 'Grades', 'url' => 'index.php?r=program/grade'],
        ]],
        ['label' => '<i class="paperfont left pixel15 paper-calendar"></i>' . 'Term Setting', 'items' => [
            ['label' => '<i class="paperfont left pixel15 paper-calendar"></i>' .'Academic Year', 'url' => 'index.php?r=term/academic-year'],
            ['label' => '<i class="paperfont left pixel15 paper-calendar1"></i>' . 'Semester', 'url' => 'index.php?r=term/semester'],
            ['label' => '<i class="paperfont left pixel15 paper-calendar2"></i>' . 'Term', 'url' => 'index.php?r=term/term'],
        ]],
    ]],
];
$setting =[
    ['label' =>'<i class="paperfont left pixel15 paper-setting"></i>' . 'Setting', 'active'=>true, 'items' => [
        ['label' =>'<i class="paperfont left pixel15 paper-map"></i>' . 'Address', 'url' => 'index.php?r=setting/address'],
        ['label' =>'<i class="paperfont left pixel15 paper-users"></i>' . 'Users', 'url' => 'index.php?r=user/admin/index'],
        ['label' =>'<i class="paperfont left pixel15 paper-anchor"></i>' . 'Appendix', 'url' => 'index.php?r=setting/appendix'],
        ['label' =>'<i class="paperfont left pixel15 paper-tool"></i>' . 'Config', 'url' => 'index.php?r=setting/configuration'],
        '<li class="divider"></li>',
        ['label' => '<i class="paperfont left pixel15 paper-tool1"></i>' . 'Gii Tool', 'url' => 'index.php?r=gii'],
    ]],
];
$tool = [
    '<li class="divider"></li>',

];
if (\Yii::$app->user->can('frontdesk-staff')){
    $items = \yii\helpers\ArrayHelper::merge($frontdesk,$items);
}

if (\Yii::$app->user->can('finance-staff')){
$items = \yii\helpers\ArrayHelper::merge($finance,$items);
}
if (\Yii::$app->user->can('academic-staff')){
$items =  \yii\helpers\ArrayHelper::merge($people, $academic ,$items);
}

if(\Yii::$app->user->can('admin')){
$items =  \yii\helpers\ArrayHelper::merge($items,$setting);
}

echo NavX::widget([
    'encodeLabels' => false,
    'options'=>['class'=>'navbar-nav navbar-right'],
    'items' => Yii::$app->user->isGuest ? $guest : \yii\helpers\ArrayHelper::merge($home,$items, $tool),
]);

NotificationsWidget::widget([
    'theme' => NotificationsWidget::THEME_GROWL,
    'clientOptions' => [
        'location' => 'br',
    ],
    'counters' => [
        '.notifications-header-count',
        '.notifications-icon-count'
    ],
    'markAllSeenSelector' => '#notification-seen-all',
    'listSelector' => '#notifications',
]);

NavBar::end();
?>