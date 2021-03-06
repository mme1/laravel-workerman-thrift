<?php
namespace App\Library\Thrift\Server;

/**
 * Autogenerated by Thrift Compiler (0.12.0)
 *
 * DO NOT EDIT UNLESS YOU ARE SURE THAT YOU KNOW WHAT YOU ARE DOING
 *  @generated
 */
use Thrift\Base\TBase;
use Thrift\Type\TType;
use Thrift\Type\TMessageType;
use Thrift\Exception\TException;
use Thrift\Exception\TProtocolException;
use Thrift\Protocol\TProtocol;
use Thrift\Protocol\TBinaryProtocolAccelerated;
use Thrift\Exception\TApplicationException;

class CalculatorProcessor
{
    protected $handler_ = null;
    public function __construct($handler)
    {
        $this->handler_ = $handler;
    }

    public function process($input, $output)
    {
        $rseqid = 0;
        $fname = null;
        $mtype = 0;

        $input->readMessageBegin($fname, $mtype, $rseqid);
        $methodname = 'process_'.$fname;
        if (!method_exists($this, $methodname)) {
              $input->skip(TType::STRUCT);
              $input->readMessageEnd();
              $x = new TApplicationException('Function '.$fname.' not implemented.', TApplicationException::UNKNOWN_METHOD);
              $output->writeMessageBegin($fname, TMessageType::EXCEPTION, $rseqid);
              $x->write($output);
              $output->writeMessageEnd();
              $output->getTransport()->flush();
              return;
        }
        $this->$methodname($rseqid, $input, $output);
        return true;
    }

    protected function process_calculate($seqid, $input, $output)
    {
        $bin_accel = ($input instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_read_binary_after_message_begin');
        if ($bin_accel) {
            $args = thrift_protocol_read_binary_after_message_begin(
                $input,
                '\App\Library\Thrift\Server\Calculator_calculate_args',
                $input->isStrictRead()
            );
        } else {
            $args = new \App\Library\Thrift\Server\Calculator_calculate_args();
            $args->read($input);
        }
        $input->readMessageEnd();
        $result = new \App\Library\Thrift\Server\Calculator_calculate_result();
        try {
            $result->success = $this->handler_->calculate($args->num1, $args->num2, $args->op);
        } catch (\App\Library\Thrift\Server\InvalidOperation $ouch) {
            $result->ouch = $ouch;
        }
        $bin_accel = ($output instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_write_binary');
        if ($bin_accel) {
            thrift_protocol_write_binary(
                $output,
                'calculate',
                TMessageType::REPLY,
                $result,
                $seqid,
                $output->isStrictWrite()
            );
        } else {
            $output->writeMessageBegin('calculate', TMessageType::REPLY, $seqid);
            $result->write($output);
            $output->writeMessageEnd();
            $output->getTransport()->flush();
        }
    }
    protected function process_echoString($seqid, $input, $output)
    {
        $bin_accel = ($input instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_read_binary_after_message_begin');
        if ($bin_accel) {
            $args = thrift_protocol_read_binary_after_message_begin(
                $input,
                '\App\Library\Thrift\Server\Calculator_echoString_args',
                $input->isStrictRead()
            );
        } else {
            $args = new \App\Library\Thrift\Server\Calculator_echoString_args();
            $args->read($input);
        }
        $input->readMessageEnd();
        $result = new \App\Library\Thrift\Server\Calculator_echoString_result();
        $result->success = $this->handler_->echoString($args->str);
        $bin_accel = ($output instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_write_binary');
        if ($bin_accel) {
            thrift_protocol_write_binary(
                $output,
                'echoString',
                TMessageType::REPLY,
                $result,
                $seqid,
                $output->isStrictWrite()
            );
        } else {
            $output->writeMessageBegin('echoString', TMessageType::REPLY, $seqid);
            $result->write($output);
            $output->writeMessageEnd();
            $output->getTransport()->flush();
        }
    }
}
