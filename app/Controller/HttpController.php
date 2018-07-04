<?php
namespace MonsterPHP\App\Controller;
use Aura\Web\Request;
use Aura\Web\Response;
use MonsterPHP\Foundation\Application;
use MonsterPHP\Foundation\Json;

/**
 * Class HttpController
 * @property \MonsterPHP\Foundation\Db $db
 */
class HttpController
{
    /**
     * @var Application
     */
    protected $app;
    protected $request;
    protected $response;

    public function setApp(Application $app){
        $this->app = $app;
    }

    public function setRequest(Request $request){
        $this->request = $request;
    }

    public function setResponse(Response $response){
        $this->response = $response;
    }

    public function __get($name){
        return $this->app->get($name);
    }


    /**
     * 执行成功返回
     * @param array $data
     */
    protected function success(Array $data=[]){
        $json = Json::cnJsonEncode(['code'=>'001','info'=>'请求成功','data'=>$data]);
        $this->jsonResponse($json);
    }

    /**
     * 执行失败返回
     * @param string $info
     * @param array $data
     */
    protected function error(String $info,Array $data=[]){
        $json = Json::cnJsonEncode(['code'=>'001','info'=>$info,'data'=>$data]);
        $this->jsonResponse($json);
    }

    /**
     * 其他状态返回
     * @param String $code
     * @param String $info
     * @param array $data
     */
    protected function other(String $code,String $info,Array $data=[]){
        $json = Json::cnJsonEncode(['code'=>$code,'info'=>$info,'data'=>$data]);
        $this->jsonResponse($json);
    }

    private function jsonResponse($json){
        $this->response->content->setType('application/json');
        $this->response->content->set($json);
        $this->sendResponse();
    }

    private function sendResponse(){
        // send status line
        header($this->response->status->get(), true, $this->response->status->getCode());

        // send non-cookie headers
        foreach ($this->response->headers->get() as $label => $value) {
            if (is_array($value)) {
                foreach ($value as $val) {
                    header("{$label}: {$val}", false);
                }
            } else {
                header("{$label}: {$value}");
            }
        }

        // send cookies
        foreach ($this->response->cookies->get() as $name => $cookie) {
            setcookie(
                $name,
                $cookie['value'],
                $cookie['expire'],
                $cookie['path'],
                $cookie['domain'],
                $cookie['secure'],
                $cookie['httponly']
            );
        }

        // send content
        echo $this->response->content->get();
        exit();
    }
}