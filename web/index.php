<?php

header('X-Powered-By: GENERATION build 9.0.2rc beta');

defined('WEB_CONTEXT') or define('WEB_CONTEXT', 'Click statistic');

if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    if (substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) === 'ru') {
        defined('WEB_LANG') or define('WEB_LANG', 'ru-RU');
    } elseif (substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) === 'ua') {
        defined('WEB_LANG') or define('WEB_LANG', 'ua-UA');
    }
} else {
    defined('WEB_LANG') or define('WEB_LANG', 'en-EN');
}

if ($_SERVER['REMOTE_ADDR'] === '127.0.0.1' || $_SERVER['REMOTE_ADDR'] === '192.168.10.123') {
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'dev');
} else {
    defined('YII_DEBUG') or define('YII_DEBUG', false);
    defined('YII_ENV') or define('YII_ENV', 'prod');
}


require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
