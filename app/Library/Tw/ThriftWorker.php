<?php

/**
 * 实现workerman接管thrift
 *
 * @author mengyu (meng___yu@126.com)
 */
namespace App\Library\Tw;
use Workerman\Worker;

use Thrift\Transport\TSocket;
use App\Library\Rpc\Regist\RegistService;


/**
 * 
 *  ThriftWorker
 * @author mengyu <meng___yu@126.com>
 */
class ThriftWorker extends Worker 
{
    /**
     * Thrift processor
     * @var object 
     */
    protected $processor = null;
    
    /**
     * 使用的协议,默认TBinaryProtocol,可更改
     * @var string
     */
    public $thriftProtocol = 'TBinaryProtocol';
    
    /**
     * 使用的传输类,默认是TBufferedTransport，可更改
     * @var string
     */
    public $thriftTransport = 'TBufferedTransport';


    /**
     * construct
     */
    public function __construct($socket_name)
    {
        parent::__construct($socket_name);
        $this->onWorkerStart = array($this, 'onStart');
        $this->onConnect = array($this, 'onConnect');
    }
    
    /**
     * 进程启动时做的一些初始化工作
     *
     * @return void
     */
    public function onStart()
    {
        $g = new RegistService();
        $this->processor = $g->getProcess();
    }
    
    /**
     * 处理受到的数据
     * @param TcpConnection $connection
     * @return void
     */
    public function onConnect($connection)
    {
        $socket = $connection->getSocket();
        $t_socket = new TSocket($connection->getRemoteIp(), $connection->getRemotePort());
        $t_socket->setHandle($socket);
        $transport_name = '\\Thrift\\Transport\\'.$this->thriftTransport;
        $transport = new $transport_name($t_socket);
        $protocol_name = '\\Thrift\\Protocol\\' . $this->thriftProtocol;
        $protocol = new $protocol_name($transport);
        
        // 执行处理
        try{
            // 先初始化一个
            $protocol->fname = 'none';
            $this->processor->process($protocol, $protocol);
        }
        catch(\Exception $e)
        {
            $connection->send($e->getMessage());
        }
        
    }
    
}
