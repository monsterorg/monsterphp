<?php
namespace MonsterPHP\Foundation;

use Aura\Di\Container;
use Aura\Di\Injection\InjectionFactory;
use Aura\Di\Resolver\Reflector;
use Aura\Di\Resolver\Resolver;

class Application extends Container{
    /**
     * 应用版本号
     *
     * @var string
     */
    const VERSION = '1.0.0';

    /**
     * 当前应用实例
     *
     * @var static
     */
    private static $instance = null;

    /**
     * app目录的绝对路径
     *
     * @var string
     */
    private $appPath;

    /**
     * 创建应用实例
     * @param string $appPath 应用绝对路径
     */
    public function __construct($appPath){
        $resolver = new Resolver(new Reflector());
        parent::__construct(new InjectionFactory($resolver));
        $this->appPath = $appPath;
        Config::load($appPath . '/Config/develop.ini');
        $this->registerServices();
        self::$instance = $this;
    }

    public static function getInstance(){
        return self::$instance;
    }

    protected function registerServices(){
        $services = include $this->appPath . '/Config/services.php';
        foreach ($services as $name=>$val){
            $this->set($name,$val);
        }
    }

}