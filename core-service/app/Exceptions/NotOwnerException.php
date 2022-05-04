<?php

namespace App\Exceptions;

use Exception;

class NotOwnerException extends Exception
{
    protected $message = 'Not your id!';

    protected $code = 400;
}
