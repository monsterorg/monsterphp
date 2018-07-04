<?php
namespace MonsterPHP\Foundation;

class Config{
    private static $ini;
    public static function load($path){
        $ini = parse_ini_file($path,true);
        if(is_file($ini['production']['ini'])){
            self::$ini = parse_ini_file($ini['production']['ini'],true);
        }
        else{
            self::$ini = $ini;
        }
    }

    public static function get($key){
        $key_array = explode('.',$key);
        $value = null;
        foreach ($key_array as $k){
            $value = self::$ini[$k];
        }
        return $value;
    }
}