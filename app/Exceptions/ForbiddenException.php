<?php

namespace App\Exceptions;

use Exception;

class ForbiddenException extends Exception
{
    public function __construct(string $message = 'Access denied', int $code = 401,  \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
