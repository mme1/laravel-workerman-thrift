<?php
namespace App\Library\Rpc;

use App\Library\Thrift\Server\CalculatorIf;

class TestServer implements CalculatorIf
{

    /**
     *
     * @param string $params
     * @return string
     */
    public function calculate($num1, $num2, $op)
    {
        // TODO: Implement helloWorld() method.
        return $num1 + $num2 + $op+222;
    }

    public function echoString($params)
    {
        // TODO: Implement helloWorld() method.
        return $params;
    }
}