<?php
use MonsterPHP\Foundation\Config;
use MonsterPHP\Foundation\Db;
return [
    'db'=>function(){
        $config = Config::get('db');
        return new Db($config['type'],$config['host'],$config['dbname'],$config['username'],$config['password']);
    }
];