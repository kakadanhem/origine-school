<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'name' => 'Origine School Management Information System',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '@app/messages',
                    //'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'sdf3w45rttgydre65tyd55',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        /*'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],*/
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,

        'pdf' => [
            'class' => \kartik\mpdf\Pdf::classname(),
            'mode' => \kartik\mpdf\Pdf::MODE_CORE,
            'format' => \kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
            // refer settings section for all configuration options
        ],
        'authManager' => [
            'class' => 'Da\User\Component\AuthDbManagerComponent',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
	'modules' => [
        'user' => [
            'class' => Da\User\Module::class,
            'enableRegistration' => false,
            'administrators' => ['kakada']
        ],
        'finance' => [
            'class' => 'app\modules\finance\finance',
            'layout' => 'layout',
        ],
        'setting' => [
            'class' => 'app\modules\setting\setting',
            'layout' => 'layout',
        ],
        'people' => [
            'class' => 'app\modules\people\people',
            'layout' => 'layout',
        ],
		'enrollment-tool' => [
            'class' => 'app\modules\academic\EnrollmentTool\EnrollmentTool',
            'layout' => 'layout',
        ],
        'school' => [
            'class' => 'app\modules\academic\school\school',
            'layout' => 'layout',
        ],
        'term' => [
            'class' => 'app\modules\academic\term\term',
            'layout' => 'layout',
        ],
        'program' => [
            'class' => 'app\modules\academic\program\program',
            'layout' => 'layout',
        ],
		'gridview' => [
          'class' => '\kartik\grid\Module',
			// see settings on http://demos.krajee.com/grid#module
		],
		'datecontrol' => [
          'class' => '\kartik\datecontrol\Module',
			// see settings on http://demos.krajee.com/datecontrol#module
		],
			// If you use tree table
		'treemanager' =>  [
          'class' => '\kartik\tree\Module',
          // see settings on http://demos.krajee.com/tree-manager#module
		]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
/*    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];*/

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
		'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '192.168.178.20'] // adjust this to your needs
    ];
}

return $config;
