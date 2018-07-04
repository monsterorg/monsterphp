<?php
//本项目无需服务器配置任何url重写，仅需外部入口中引入本文件即可使用
define('BASE_PATH',dirname(__DIR__));
include dirname(__DIR__) . '/vendor/autoload.php';
$app = new \MonsterPHP\Foundation\HttpApplication(dirname(__DIR__).'/app');
$app->run();

