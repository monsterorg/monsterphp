<?php
namespace MonsterPHP\Foundation;

class Model{
    protected $saveCols = [];

    public function save(){

    }

    public function delete(){

    }

    public function __set($name, $value){
        if($this->$name != $value){
            $this->saveCols[] = $name;
        }
        $this->$name = $value;
    }

    public static function find($options=[]){


    }

    public static function findFirst($options=[]){
        
    }

}