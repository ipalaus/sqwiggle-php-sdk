<?php

namespace Ipalaus\Sqwiggle\Exceptions;

class BadResponseException extends SqwiggleException
{

    protected $type;
    protected $param;

    public function __construct($error)
    {
        $this->type = $error['type'];
        $this->param = isset($error['param']) ? $error['param'] : null;

        $message = $error['param'].' '.$error['message'];

        parent::__construct($message);
    }

    public function getError()
    {
        return array(
            'type' => $this->type,
            'param' => $this->param,
            'message' => $this->message,
        );
    }

}
