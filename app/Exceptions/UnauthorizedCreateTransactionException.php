<?php

namespace App\Exceptions;

use Exception;

class UnauthorizedCreateTransactionException extends Exception
{
    protected $message;
    protected $code = 500;

    public function __construct()
    {
        parent::__construct(__('exceptions.unauthorizedCreateTransactionException'), $this->code);
    }
}
