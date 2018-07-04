<?php
namespace MonsterPHP\Foundation;

use Aura\Sql\ExtendedPdo;
use Aura\Sql\Profiler\Profiler;
use Aura\SqlQuery\QueryFactory;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;
use Monolog\Processor\PsrLogMessageProcessor;

class Db extends ExtendedPdo{
    const LOG_FILE = '/log/db.log';
    private $query;
    public function __construct(
        string $dbType,
        string $host,
        string $dbName,
        string $username,
        string $password
    ){
        $dsn = "$dbType:host=$host;dbname=$dbName";
        parent::__construct($dsn,$username,$password);
        $this->query = new QueryFactory($dbType,QueryFactory::COMMON);
        $log = new Logger('db');
        $log->pushProcessor(new PsrLogMessageProcessor);
        $format = new LineFormatter("[%datetime%] %channel%.%level_name%: %message%\n");
        $stream = new StreamHandler(BASE_PATH.self::LOG_FILE,Logger::DEBUG);
        $stream->setFormatter($format);
        $log->pushHandler($stream);
        $this->setProfiler(new Profiler($log));
        $this->getProfiler()->setLogFormat("{function}:{statement} {duration}");
        $this->getProfiler()->setActive(true);
    }

    public function select(){
        return $this->query->newSelect();
    }

    public function insert(){
        return $this->query->newInsert();
    }

    public function update(){
        return $this->query->newUpdate();
    }

    public function delect(){
        return $this->query->newDelete();
    }

}