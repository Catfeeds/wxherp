<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/params.php')
);

$config = [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_backend_csrf',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_backend_identity', 'httpOnly' => true],
            'loginUrl' => ['/site/login'],
        ],
        'session' => [
            'name' => '_backend_session',
        ],
    ],
    'modules' => [
        'restaurant' => [
            'class' => 'backend\modules\restaurant\Module',
        ],
        'store' => [
            'class' => 'backend\modules\store\Module',
        ],
        'toeat' => [
            'class' => 'backend\modules\toeat\Module',
        ],
        'event' => [
            'class' => 'backend\modules\event\Module',
        ],
        'article' => [
            'class' => 'backend\modules\article\Module',
        ],
        'user' => [
            'class' => 'backend\modules\user\Module',
        ],
        'ad' => [
            'class' => 'backend\modules\ad\Module',
        ],
        'link' => [
            'class' => 'backend\modules\link\Module',
        ],
        'notity' => [
            'class' => 'backend\modules\notity\Module',
        ],
        'areas' => [
            'class' => 'backend\modules\areas\Module',
        ],
        'route' => [
            'class' => 'backend\modules\route\Module',
        ],
        'payment' => [
            'class' => 'backend\modules\payment\Module',
        ],
        'upload' => [
            'class' => 'backend\modules\upload\Module',
        ],
        'feedback' => [
            'class' => 'backend\modules\feedback\Module',
        ],
        'oauth' => [
            'class' => 'backend\modules\oauth\Module',
        ],
    ],
    'params' => $params,
];
return $config;
