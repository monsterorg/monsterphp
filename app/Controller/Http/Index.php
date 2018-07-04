<?php
namespace MonsterPHP\App\Controller\Http;
use MonsterPHP\App\Controller\HttpController;

class Index extends HttpController
{
    public function index(){
        $sql = $this->db->select()
            ->cols(['*'])
            ->from('sys_user')
            ->where('id=1 and username=:name',['name'=>'admin'])
            ->getStatement();
        $rs = $this->db->fetchAll($sql);
        print_r($rs);
        //$this->success($rs);
    }
}