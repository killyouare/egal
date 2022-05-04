<?php

namespace App\Exceptions;

use Exception;

class IdFieldException extends Exception
{

    protected $message = 'id is extra field';

    protected $code = 400;
}
