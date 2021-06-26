<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            // 'admin/*',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ]
    ],
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'container' => [
        'definitions' => [
            yii\grid\ActionColumn::class => app\components\grid\ActionColumn::class,
            yii\grid\GridView::class => [
                'tableOptions' => [
                    'class' => 'card-table table'
                ],
                'headerRowOptions' => [
                    'class' => 'text-nowrap text-center'
                ],
                'rowOptions' => [
                    'class' => 'text-nowrap'
                ],
                'layout' =>
                    '<div class="table-responsive">' .
                    '<div class="card-body p-0">' .
                    "{items}" .
                    '</div>' .
                    '<div class="card-footer pt-4 pb-2">' .
                    '<div class="d-flex justify-content-between align-items-baseline">' . "{pager}{summary}" . '</div>' .
                    '</div>' .
                    '</div>'
            ],
            yii\widgets\DetailView::class => [
                'options' => [
                    'class' => 'card-table table'
                ],
            ],
            yii\data\Pagination::class => ['pageSize' => 10],
            yii\widgets\LinkPager::class => yii\bootstrap4\LinkPager::class,
            kartik\grid\GridView::class => [
                'tableOptions' => [
                    'class' => 'card-table table'
                ],
                // 'layout' => "{items}\n <div class='d-flex justify-content-between'>{pager}{summary}</div>",
                'panel' =>false,
                'layout' =>
                    '<div class="table-responsive">' .
                    '<div class="card-body p-0">' .
                    "{items}" .
                    '</div>' .
                    '<div class="card-footer pt-4 pb-2">' .
                    '<div class="d-flex justify-content-between align-items-baseline">' . "{pager}{summary}" . '</div>' .
                    '</div>' .
                    '</div>'
            ],
            kartik\grid\ActionColumn::class => [
                'header' => "Act",
                'mergeHeader' => false,
                'dropdown' => false,
                'vAlign' => 'middle',
                'urlCreator' => function ($action, $model, $key, $index) {
                    return yii\helpers\Url::to([$action, 'id' => $key]);
                },
                'dropdownButton' => [
                    'label' => '',
                    'class' => 'btn btn-outline-secondary btn-sm'
                ],
                'buttons' => [
                    'header' => function ($url, $model, $index) {
                        return '<h6 class="dropdown-header text-left text-primary">' . $model->id . '</h6>';
                    },
                    'divider' => function () {
                        return '<div class="dropdown-divider"></div>';
                    },
                ],
                'contentOptions' => [
                    'class' => 'text-nowrap text-center'
                ],
                'viewOptions' => [
                    'role' => 'modal-remote',
                    'title' => 'View',
                    'data-toggle' => 'tooltip'
                ],
                'updateOptions' => [
                    'role' => 'modal-remote',
                    'title' => 'Update',
                    'data-toggle' => 'tooltip'
                ],
                'deleteOptions' => [
                    'role' => 'modal-remote',
                    'title' => 'Delete',
                    'class' => 'text-danger',
                    'data-confirm' => false,
                    'data-method' => false,// for override yii data api
                    'data-request-method' => 'post',
                    'data-toggle' => 'tooltip',
                    'data-confirm-title' => 'Are you sure?',
                    'data-confirm-message' => 'Are you sure want to delete this item'
                ],
            ],
            kartik\date\DatePicker::class => [
                'type' => kartik\date\DatePicker::TYPE_INPUT,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-mm-yyyy',
                    'todayHighlight' => true
                ]
            ],
            kartik\widgets\DateTimePicker::class => [
                'type' => kartik\widgets\DateTimePicker::TYPE_INPUT,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-mm-yyyy hh:ii'
                ]
            ]
        ]
    ],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['user-default']
        ],
        'db' => $db,
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'formatter' => [
            'class' => 'app\components\MyFormatter',
            'defaultTimeZone' => 'Asia/Jakarta',
            'dateFormat' => 'php:d-m-Y',
            'datetimeFormat' => 'php:d-m-Y, H:i',
            'timeFormat' => 'php:H:i',
            'thousandSeparator' => ",",
            'decimalSeparator' => '.',

            'currencyCode' => "Rp.",
            'numberFormatterOptions' => [
                NumberFormatter::MIN_FRACTION_DIGITS => 0,
                NumberFormatter::MAX_FRACTION_DIGITS => 2,
            ],
            'nullDisplay' => '',
            'locale' => 'id-ID', //your language locale
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages', // if advanced application, set @frontend/messages
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        //'main' => 'main.php',
                    ],
                ],
            ],
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
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'pdf' => [
            'class' => kartik\mpdf\Pdf::class,
            'format' => kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => kartik\mpdf\Pdf::DEST_BROWSER,
            'cssFile' => '@webroot/css/pdf-report.css',
            'methods' => [
                'SetHeader' => ['TRESNAMUDA GROUP'],
                'SetFooter' => ['{PAGENO}'],
            ],
            'options' => [
                'showWatermarkText' => true
            ]
        ],
        'pdfDenganHeaderDariAplikasi' => [
            'class' => kartik\mpdf\Pdf::class,
            'format' => kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => kartik\mpdf\Pdf::DEST_BROWSER,
            'cssFile' => '@webroot/css/pdf-report.css',
            'methods' => [
                'SetHTMLHeader' => widgets\PdfHtmlHeader::widget(), # FAILED
                'SetDisplayMode' => 'fullpage',
                'SetDisplayPreferences' => '/HideMenubar/HideToolbar/DisplayDocTitle/FitWindow'
            ],
            'marginTop' => '32',
            'marginHeader' => '5'
        ],
        'pdfDenganMinimalMargin' => [
            'class' => kartik\mpdf\Pdf::class,
            'format' => kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => kartik\mpdf\Pdf::DEST_BROWSER,
            'cssFile' => '@webroot/css/pdf-report.css',
            'methods' => [
                'SetDisplayMode' => 'fullpage',
                'SetDisplayPreferences' => '/HideMenubar/HideToolbar/DisplayDocTitle/FitWindow'
            ],
            'marginTop' => '2',
            'marginLeft' => '2',
            'marginBottom' => '4',
            'marginRight' => '2',
        ],
        'pdfDenganMinimalMarginJugaHeaderDariAplikasi' => [
            'class' => kartik\mpdf\Pdf::class,
            'format' => kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => kartik\mpdf\Pdf::ORIENT_LANDSCAPE,
            'destination' => kartik\mpdf\Pdf::DEST_BROWSER,
            'cssFile' => '@webroot/css/pdf-report.css',
            'methods' => [
                'SetHTMLHeader' => widgets\PdfHtmlHeader::widget(), # FAILED
                'SetDisplayMode' => 'fullpage',
                'SetDisplayPreferences' => '/HideMenubar/HideToolbar/DisplayDocTitle/FitWindow'
            ],
            'marginTop' => '32',
            'marginHeader' => '5',
            'marginLeft' => '2',
            'marginBottom' => '4',
            'marginRight' => '2',
        ],
        'pdfDenganHeaderTercetakDariKertasnyaLangsung' => [
            'class' => kartik\mpdf\Pdf::class,
            'format' => kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => kartik\mpdf\Pdf::DEST_BROWSER,
            'cssFile' => '@webroot/css/pdf-report.css',
            'marginTop' => '50',
            'marginHeader' => '5'
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'BDJXVhHOg0ZurNKLqJ2a_keyCpeT4DRv',
        ],
        'session' => [

            // this is the name of the session cookie used for login on the backend
            'name' => getenv('SESSION_NAME'),
            'timeout' => 86400, // 1 Day
            'class' => 'yii\web\DbSession',
            'writeCallback' => function($session){
                return [
                    'user_id' => Yii::$app->user->id,
                    'last_write' => time(),
                ];
            }
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'home' => 'site/index',

                // route superadmin => mimin
                'mini-role' => 'mimin/role/index',
                'mini-role/create' => 'mimin/role/create',
                'mini-role/permission' => 'mimin/role/permission',
                'mini-role/update' => 'mimin/role/update',
                'mini-role/view' => 'mimin/role/view',
                'mini-role/delete' => 'mimin/role/delete',

                'mini-route' => 'mimin/route/index',
                'mini-route/create' => 'mimin/route/create',
                'mini-route/generate' => 'mimin/route/generate',
                'mini-route/update' => 'mimin/route/update',
                'mini-route/view' => 'mimin/route/view',
                'mini-route/delete' => 'mimin/route/delete',

                'mini-user' => 'mimin/user/index',
                'mini-user/create' => 'mimin/user/create',
                'mini-user/update' => 'mimin/user/update',
                'mini-user/view' => 'mimin/user/view',
                'mini-user/delete' => 'mimin/user/delete',
            ],
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
    ],
    'id' => 'basic',
    'language' => 'id-ID',
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            'viewPath' => '@app/modules/superadmin/views/mdm',
        ],
        'datecontrol' => [
            'class' => 'kartik\datecontrol\Module',

            // format settings for displaying each date attribute (ICU format example)
            'displaySettings' => [
                kartik\datecontrol\Module::FORMAT_DATE => 'php:d-m-Y',
                kartik\datecontrol\Module::FORMAT_TIME => 'php:H:i',
                kartik\datecontrol\Module::FORMAT_DATETIME => 'php:d-m-Y H:i',
            ],

            // format settings for saving each date attribute (PHP format example)
            'saveSettings' => [
                kartik\datecontrol\Module::FORMAT_DATE => 'php:Y-m-d', // saves as unix timestamp
                kartik\datecontrol\Module::FORMAT_TIME => 'php:H:i:s',
                kartik\datecontrol\Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
            ],

            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true,

            // default settings for each widget from kartik\widgets used when autoWidget is true
            'autoWidgetSettings' => [
                kartik\datecontrol\Module::FORMAT_DATE => [
                    'type' => 2,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'todayHighlight' => true,
                        'zIndexOffset' => 10000
                    ],
                ], // example
                kartik\datecontrol\Module::FORMAT_DATETIME => [
                    'type' => 1,
                    'options' => [
                        'class' => 'date-time-picker'
                    ],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'minuteStep' => 1,
                        'position' => 'bottom',
                        'todayHighlight' => true,
                    ]
                ], // setup if needed
                kartik\datecontrol\Module::FORMAT_TIME => [], // setup if needed
            ],
            'widgetSettings' => [
                kartik\datecontrol\Module::FORMAT_DATE => [
                    'class' => 'yii\jui\DatePicker',
                    'options' => [
                        //'dateFormat' =>  'php:d-m-Y',
                        'options' => ['class' => 'form-control picker'],
                    ]
                ],
            ]
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
        'mimin' => [
            'class' => 'hscstudio\mimin\Module',
            'defaultRoute' => '/superadmin/default',
            'viewPath' => '@app/modules/superadmin/views/mimin',
            'controllerMap' => [
                'user' => 'app\modules\superadmin\controllers\MiniUserController',
                'route' => 'app\modules\superadmin\controllers\MiniRouteController',
                'role' => 'app\modules\superadmin\controllers\MiniRoleController'
            ],
        ],
        'superadmin' => [
            'class' => 'app\modules\superadmin\Module',
            'defaultRoute' => '/superadmin/default',
        ],
    ],
    'name' => 'SIHRD',
    'params' => $params,
    'timeZone' => 'Asia/Jakarta',
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', "*"],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', "*"],
        'generators' => [

            'dzilcrud' => [
                'class' => 'app\generators\dzilcrud\generators\Generator',
                'templates' => [
                    'master-details' => '@app/generators/dzilcrud/generators/masterdetails', // template name => path to template
                    'master-details-details' => '@app/generators/dzilcrud/generators/masterdetailsdetails', // template name => path to template
                ]
            ],

            'dzilajaxcrud' => [
                'class' => 'app\generators\dzilajaxcrud\generators\Generator',
                'templates' => [
                    'master-details' => '@app/generators/dzilajaxcrud/generators/masterdetails', // template name => path to template
                    'master-details-details' => '@app/generators/dzilajaxcrud/generators/masterdetailsdetails', // template name => path to template
                ]
            ],


        ],
    ];
}

return $config;
