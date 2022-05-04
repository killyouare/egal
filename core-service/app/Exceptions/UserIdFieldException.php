<?php

namespace App\Exceptions;

use Exception;

class UserIdFieldException extends Exception
{

    protected $message = 'user_id is extra field';

    protected $code = 400;
}
