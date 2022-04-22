<?php

namespace App\Exceptions;

use Exception;

class StudentCapacityException extends Exception
{

    protected $message = 'The course is full!';

    protected $code = 400;
}
