<?php

namespace Manao\Utils;

use Exception;
use Throwable;

class AppExeption extends Exception
{
    public function __construct($message = '',Logger $logger, $code = 0, Throwable $previous = null)
    {
        $logger->log($message);
        
        parent::__construct($message, $code, $previous);
    }
}