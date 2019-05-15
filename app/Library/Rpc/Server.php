<?php
namespace App\Library\Rpc;

use App\Library\Thrift\Server\sayHelloServiceIf;

class Server implements sayHelloServiceIf
{

    /**
     *
     * @param string $params
     * @return string
     */
    public function helloWorld($params)
    {
        // TODO: Implement helloWorld() method.
        return $params;
    }
}