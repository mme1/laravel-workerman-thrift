<?php

/**
 * 服务注册配置
 * @author mengyu (meng___yu@126.com)
 * eg.
 * processor：thrift 生成的 Processor 类名
 * registName：注册名，用于client调用
 * className：实现thrift 服务的类名
 *
 *
 */

$config = [
    [
    'processor'=>'sayHelloServiceProcessor',
    'registName'=>'sayHelloService',
    'className' =>'Server',
    ],
    [
    'processor'=>'CalculatorProcessor',
    'registName'=>'Calculator',
    'className' =>'TestServer',
    ]
];

return $config;