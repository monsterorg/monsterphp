<?php
namespace MonsterPHP\Foundation;
class Json
{
    /**
     * 支持中文的数组转json
     * @param array $arr
     * @return string
     */
    public static function cnJsonEncode(Array $arr){
        return json_encode($arr,JSON_UNESCAPED_UNICODE|JSON_BIGINT_AS_STRING);
    }
}