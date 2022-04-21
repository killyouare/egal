<?php

namespace App\Exceptions;

use Exception;

class EmptyPasswordException extends Exception
{

    protected $message = 'Empty password!';

    protected $code = 400;

}
