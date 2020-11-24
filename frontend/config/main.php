<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

//$oname = \app\models\Organisation::find()->one()->name;

return [
    'id' => '',
    'name' => 'Micro-Finance',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' =>[
         'gridview' => [
            'class' => '\kartik\grid\Module'
        // enter optional module parameters below - only if you need to  
        // use your own export download action or custom translation 
        // message source
        // 'downloadAction' => 'gridview/export/download',
        // 'i18n' => []
        ]
    ],
    'components' => [
        'formatter' => [
        'class' => 'yii\i18n\Formatter',
        'nullDisplay' => '',
    ],
         //theme
    //      'view' => [
    //     'theme' => [
    //         'pathMap' => [
    //             '@app/views' => '@webroot/themes/red-zen'
    //         ],
    //         'baseUrl'   => '@web/themes/red-zen',
    //     ],
    // ], 


//   'view' =>array(
//     'theme' => array(
//     'pathMap' => array('@app/views' => '@wwwroot/themes/THEME_FOLDER_NAME'),
//     'baseUrl'   => '@www/themes/THEME_FOLDER_NAME'
//   )
// )

    //theme



        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            //'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
             'enableAutoLogin' => false,// session timeout
            'authTimeout' => 3000,// session timeout
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
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
    'params' => $params,
];
