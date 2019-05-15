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

class Calculator_calculate_result
{
    static public $isValidate = false;

    static public $_TSPEC = array(
        0 => array(
            'var' => 'success',
            'isRequired' => false,
            'type' => TType::DOUBLE,
        ),
        1 => array(
            'var' => 'ouch',
            'isRequired' => false,
            'type' => TType::STRUCT,
            'class' => '\App\Library\Thrift\Server\InvalidOperation',
        ),
    );

    /**
     * @var double
     */
    public $success = null;
    /**
     * @var \App\Library\Thrift\Server\InvalidOperation
     */
    public $ouch = null;

    public function __construct($vals = null)
    {
        if (is_array($vals)) {
            if (isset($vals['success'])) {
                $this->success = $vals['success'];
            }
            if (isset($vals['ouch'])) {
                $this->ouch = $vals['ouch'];
            }
        }
    }

    public function getName()
    {
        return 'Calculator_calculate_result';
    }


    public function read($input)
    {
        $xfer = 0;
        $fname = null;
        $ftype = 0;
        $fid = 0;
        $xfer += $input->readStructBegin($fname);
        while (true) {
            $xfer += $input->readFieldBegin($fname, $ftype, $fid);
            if ($ftype == TType::STOP) {
                break;
            }
            switch ($fid) {
                case 0:
                    if ($ftype == TType::DOUBLE) {
                        $xfer += $input->readDouble($this->success);
                    } else {
                        $xfer += $input->skip($ftype);
                    }
                    break;
                case 1:
                    if ($ftype == TType::STRUCT) {
                        $this->ouch = new \App\Library\Thrift\Server\InvalidOperation();
                        $xfer += $this->ouch->read($input);
                    } else {
                        $xfer += $input->skip($ftype);
                    }
                    break;
                default:
                    $xfer += $input->skip($ftype);
                    break;
            }
            $xfer += $input->readFieldEnd();
        }
        $xfer += $input->readStructEnd();
        return $xfer;
    }

    public function write($output)
    {
        $xfer = 0;
        $xfer += $output->writeStructBegin('Calculator_calculate_result');
        if ($this->success !== null) {
            $xfer += $output->writeFieldBegin('success', TType::DOUBLE, 0);
            $xfer += $output->writeDouble($this->success);
            $xfer += $output->writeFieldEnd();
        }
        if ($this->ouch !== null) {
            $xfer += $output->writeFieldBegin('ouch', TType::STRUCT, 1);
            $xfer += $this->ouch->write($output);
            $xfer += $output->writeFieldEnd();
        }
        $xfer += $output->writeFieldStop();
        $xfer += $output->writeStructEnd();
        return $xfer;
    }
}