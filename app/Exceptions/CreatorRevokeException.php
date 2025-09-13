<?php

namespace App\Exceptions;

use Exception;

class CreatorRevokeException extends Exception
{
    protected $message;
    protected $code = 500;

    public function __construct()
    {
        parent::__construct(__('exceptions.creatorRevokeException'), $this->code);
    }
}
