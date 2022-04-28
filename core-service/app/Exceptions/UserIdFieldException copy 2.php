<?php

namespace App\Exceptions;

use Exception;

class LessonIdFieldException extends Exception
{

    protected $message = 'lesson_id is extra field';

    protected $code = 400;
}
