<?php
/**
 * 服务注册
 * @author mengyu (meng___yu@126.com)
 */
namespace App\Library\Rpc\Regist;
use Thrift\TMultiplexedProcessor;
class RegistService
{


    public  $process;


    public $config ;

    public function __construct()
    {
        $this->config = require_once __DIR__."/ServiceConfig.php";
    }

    public function getProcess()
    {

        return $this->regist();
    }

    /**
     * 服务注册 示例
     * $thriftProcess = new sayHelloServiceProcessor(new Server());
     *   第二个服务
     * $cthriftProcess = new CalculatorProcessor(new TestServer());
     *  注册服务
     * $processor->registerProcessor('sayHelloService', $thriftProcess);
     * $processor->registerProcessor('Calculator', $cthriftProcess);
     */
    private function regist(){
        $processor = new TMultiplexedProcessor();
        foreach ($this->config as $v){
            $t1 = "\\App\\Library\\Thrift\\Server\\".$v['processor'];
            $t2 = $v['registName'];
            $t3 = "\\App\\Library\\Rpc\\".$v['className'];
            $pr = new $t1(new $t3());
            $processor->registerProcessor($t2, $pr);
        }
        return $processor;
    }
}