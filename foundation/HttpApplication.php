<?php
namespace MonsterPHP\Foundation;
use Aura\Web\WebFactory;

class HttpApplication extends Application{

    public function run(){
        $web = new WebFactory($GLOBALS);
        $request = $web->newRequest();
        $response = $web->newResponse();
        $ac = $request->query->get('ac','unknown');
        if($ac == 'unknown'){
            //TODO:404
        }
        $ac = explode('-',$ac);
        $a = array_shift($ac);
        $ac = implode('\\',$ac);

        $this->setters['MonsterPHP\App\Controller\HttpController'] = [
            'setApp'=>$this,
            'setRequest'=>$request,
            'setResponse'=>$response
        ];
        $class = 'MonsterPHP\App\Controller\Http\\' . ucfirst($ac);
        $c = $this->newInstance($class);
        $c->$a();
    }
}