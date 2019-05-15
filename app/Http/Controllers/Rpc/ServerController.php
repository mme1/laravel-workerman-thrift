<?php
/**
 * Created by PhpStorm.
 * User: xunting
 * Date: 2019/5/13
 * Time: 11:34 AM
 */

/**
 * 服务端控制器
 */

namespace App\Http\Controllers\Rpc;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Thrift\Protocol\TBinaryProtocol;
use Thrift\Protocol\TJSONProtocol;
use Thrift\Protocol\TCompactProtocol;
use Thrift\Protocol\TSimpleJSONProtocol;
use Thrift\TMultiplexedProcessor;
use Thrift\Transport\TBufferedTransport;
use Thrift\Transport\TPhpStream;
use Thrift\Exception\TException;
use App\Library\Rpc\Server;
use App\Library\Rpc\TestServer;
use App\Library\Thrift\Server\sayHelloServiceProcessor;
use App\Library\Thrift\Server\CalculatorProcessor;

class ServerController extends Controller
{
    /**
     * 多个服务
     * @param Request $request
     */
    function handleManyRequest() {
        var_dump(3333333);

        try{
            header('Content-Type', 'application/x-thrift');

//            // 初始化多个服务提供者handle
//            $calculatorhandler = new CalculatorService();
//            $echohandler = new EchoService();
//
//            $multiplexedProcessor = new TMultiplexedProcessor();
//
//            // 创建多个服务Processor
//            $calculatorProcessor = new CalculatorProcessor($calculatorhandler);
//            $echoProcessor = new EchoProcessor($echohandler);
//
//            // 将服务注册到TMultiplexedProcessor中
//            $multiplexedProcessor->registerProcessor("calculator", $calculatorProcessor);
//            $multiplexedProcessor->registerProcessor("echo", $echoProcessor);
//
//            // 初始化数据传输方式transport
//            $transport = new TBufferedTransport(new TPhpStream(TPhpStream::MODE_R | TPhpStream::MODE_W));
//            // 利用该传输方式初始化数据传输格式protocol
//            $protocol = new TBinaryProtocol($transport, true, true);
//
//            // 开始服务
//            $transport->open();
//            $multiplexedProcessor->process($protocol, $protocol);
//            $transport->close();


            //其他

            $thriftProcess = new sayHelloServiceProcessor(new Server());

            $processor = new TMultiplexedProcessor();

            //第二个服务
            $cthriftProcess = new CalculatorProcessor(new TestServer());

            // 注册服务
            $processor->registerProcessor('sayHelloService', $thriftProcess);

            $processor->registerProcessor('Calculator', $cthriftProcess);

            //==========
            $transport = new TBufferedTransport(new TPhpStream(TPhpStream::MODE_R | TPhpStream::MODE_W));
            // 利用该传输方式初始化数据传输格式protocol
            $protocol = new TBinaryProtocol($transport, true, true);
            //$protocol = new TSimpleJSONProtocol($transport);

            // 开始服务
            $transport->open();
            $processor->process($protocol, $protocol);
            $transport->close();
            //==========



//            $transport = new TServerSocket('127.0.0.1', 10000);
//            $server = new TSimpleServer($processor, $transport, $tFactory, $tFactory, $pFactory, $pFactory);
//            $this->info("服务启动成功！");
//            $server->serve();


        } catch (TException $tx) {
            print 'TException: '.$tx->getMessage()."\n";
        }
    }
}